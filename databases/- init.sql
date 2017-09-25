#初始化SQL
SET FOREIGN_KEY_CHECKS = 0;
#活动列表
TRUNCATE TABLE ya_activity;
#活动数据
TRUNCATE TABLE ya_activity_data;
#活动票种
TRUNCATE TABLE ya_activity_ticket;
#玩家收藏的活动
TRUNCATE TABLE ya_collect_activity;
#玩家收藏的商家
TRUNCATE TABLE ya_collect_merchant;
#运营中心;
TRUNCATE TABLE ya_count;
#商家;
TRUNCATE TABLE ya_merchant;
#商家图片;
TRUNCATE TABLE ya_merchant_img;
#发送短信记录;
TRUNCATE TABLE ya_message_code;
#订单;
TRUNCATE TABLE ya_order;
#退款订单;
TRUNCATE TABLE ya_order_refund;
#订单票种;
TRUNCATE TABLE ya_order_ticket;
#员工
TRUNCATE TABLE ya_salesman;
#合同图片
TRUNCATE TABLE ya_contract;


SET FOREIGN_KEY_CHECKS = 1;


