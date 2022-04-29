# update_10w
循环分批次批量更改数据10万行记录

业务方的SQL：
UPDATE t1 SET report_status=0 WHERE create_time>'2022-04-28 00:00:00' and  create_time<'2022-04-29 00:00:00';

这个SQL要改18422654条数据，直接执行会影响业务稳定性，并且造成主从复制延迟。

固需要通过脚本，循环分批次批量更改数据10万行记录。

shell> php update_10w.php

![image](https://s4.51cto.com/images/202204/445155c3292fd31aa8b747f73f408305c61ba9.png?x-oss-process=image/watermark,size_14,text_QDUxQ1RP5Y2a5a6i,color_FFFFFF,t_100,g_se,x_10,y_10,shadow_20,type_ZmFuZ3poZW5naGVpdGk=,x-oss-process=image/resize,m_fixed,w_1184)
