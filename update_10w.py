#!/usr/bin/env python3

import sys
import time
import pymysql

mysql_server = '172.19.136.33'
mysql_username = 'admin'
mysql_password = 'hechunyang'
mysql_database = 'test'
mysql_port = 3307
mysql_table = 'sbtest1'

# 设置循环分批次批量更改数据N行记录
limit_rows = 100000

db = pymysql.connect(host = mysql_server,
                     user = mysql_username,
                     password = mysql_password,
                     database = mysql_database,
                     port = mysql_port,
                     charset = 'utf8')

cursor = db.cursor()

###################以下代码不用修改##########################
i = 0
lines = []
with open('{0}.txt'.format(mysql_table),'r',encoding="UTF-8" ) as f:
    for line in f:
        i+=1
        lines.append(line.strip())
        if i >= limit_rows:
            linestr = ','.join(lines)
            #print('UPDATE {0} SET pad=\'hechunyang\' WHERE id IN({1})' .format(mysql_table,linestr))
            try:
                # 修改成你的SQL
                rows = cursor.execute('UPDATE {0} SET pad=\'hechunyang\' WHERE id IN({1})' .format(mysql_table,linestr))
                db.commit()
                print('{0}表更改{1}行记录成功.' .format(mysql_table,rows))
                print('-' * 55)
                time.sleep(1)
            except pymysql.Error as e:
                print("Error %d: %s" % (e.args[0], e.args[1]))
                db.rollback()
                sys.exit(0)
            i = 0
            lines.clear()
    db.close()
	
print('{0}表数据更改成功.' .format(mysql_table))
