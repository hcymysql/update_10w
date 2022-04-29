# update_10w
循环分批次批量更改数据10万行记录

业务方的SQL：
UPDATE t1 SET report_status=0 WHERE create_time>'2022-04-28 00:00:00' and  create_time<'2022-04-29 00:00:00';

这个SQL要改18422654条数据，直接执行会影响业务稳定性，并且造成主从复制延迟。

固需要通过脚本，循环分批次批量更改数据10万行记录。

shell> php update_10w.php

![image](https://raw.githubusercontent.com/hcymysql/update_10w/main/update_10w.png)
