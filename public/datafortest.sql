
INSERT INTO `users` (`id`, `email`, `password`, `remember_token`, `firstname`, `lastname`, `tel`, `avatar`, `use`, `login_at`, `created_at`, `updated_at`) VALUES
(1, 'cust1@test.com', '$2y$10$Mv2i330PhJ.7iOIRoZURaO4y8S4IrB6OxWxr1ybU4qw3N/8ZveEhi', NULL, 'สมจิตร', 'คิดร้าย', '09-00000000', '', 1, '2017-05-16 16:30:00', NULL, NULL),
(2, 'cust2@test.com', '$2y$10$Mv2i330PhJ.7iOIRoZURaO4y8S4IrB6OxWxr1ybU4qw3N/8ZveEhi', NULL, 'สมหมาย', 'ใจดี', '085-1234567', '', 1, '2017-05-18 02:30:00', NULL, NULL),
(3, 'cust3@test.com', '$2y$10$Mv2i330PhJ.7iOIRoZURaO4y8S4IrB6OxWxr1ybU4qw3N/8ZveEhi', NULL, 'สมปอง', 'คนองเดช', '085-4545454', '', 1, '2017-05-18 03:30:00', NULL, NULL);

INSERT INTO `address` (`id`, `user_id`, `fullname`, `detail`, `postcode`, `tel`, `created_at`, `updated_at`) VALUES
(1, 1, 'สมจิตร คิดร้าย', '123 ถนนพระราม 3 แขวงบางโคล่ เขตบางคอแหลม กรุงเทพมหานคร', '10120', '09-00000000', NULL, NULL),
(2, 1, 'สมจิตร คิดร้าย', '111 ซอยประดู่ 1 ถนนเจริญกรุง แขวงบางคอแหลม เขตบางคอแหลม กรุงเทพมหานคร', '10120', '09-00000000', NULL, NULL),
(3, 2, 'สมหมาย ใจดี', '222 ซอยประดู่ 1 ถนนเจริญกรุง แขวงบางคอแหลม เขตบางคอแหลม กรุงเทพมหานคร', '10120', '085-1234567', NULL, NULL);

INSERT INTO `admins` (`id`, `role_id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin1', 'admin1@test.com', '$2y$10$Mv2i330PhJ.7iOIRoZURaO4y8S4IrB6OxWxr1ybU4qw3N/8ZveEhi', 'muKS60waMOcPdoexqa4vylWfjGG3EYKlfCYavmRSrppfpzYnzGap5mssB5g8', NULL, NULL),
(2, 2, 'user1', 'user1@test.com', '$2y$10$Mv2i330PhJ.7iOIRoZURaO4y8S4IrB6OxWxr1ybU4qw3N/8ZveEhi', '38R4T9SPDrzpGRySnqNszhccQ5o7eJTbeEMDg179EtvwmsVkkfPu0rXnILR5', NULL, NULL);

INSERT INTO `category` (`id`, `name`, `detail`, `created_at`, `updated_at`) VALUES
(1, 'ประเภทสินค้า 1', 'รายละเอียดประเภทสินค้า 1', '2017-05-14 22:47:48', '2017-05-14 22:47:48'),
(2, 'ประเภทสินค้า 2', 'รายละเอียดประเภทสินค้า 2', '2017-05-14 22:47:48', '2017-05-14 22:47:48'),
(3, 'ประเภทสินค้า 3', 'รายละเอียดประเภทสินค้า 3', '2017-05-14 22:47:48', '2017-05-14 22:47:48'),
(4, 'ประเภทสินค้า 4', 'รายละเอียดประเภทสินค้า 4', '2017-05-14 22:47:48', '2017-05-14 22:47:48'),
(5, 'ประเภทสินค้า 5', 'รายละเอียดประเภทสินค้า 5', '2017-05-14 22:47:49', '2017-05-14 22:47:49'),
(6, 'ประเภทสินค้า 6', 'รายละเอียดประเภทสินค้า 6', '2017-05-14 22:47:49', '2017-05-14 22:47:49'),
(7, 'ประเภทสินค้า 7', 'รายละเอียดประเภทสินค้า 7', '2017-05-14 22:47:49', '2017-05-14 22:47:49'),
(8, 'ประเภทสินค้า 8', 'รายละเอียดประเภทสินค้า 8', '2017-05-14 22:47:49', '2017-05-14 22:47:49'),
(9, 'ประเภทสินค้า 9', 'รายละเอียดประเภทสินค้า 9', '2017-05-14 22:47:49', '2017-05-14 22:47:49'),
(10, 'ประเภทสินค้า 10', 'รายละเอียดประเภทสินค้า 10', '2017-05-14 22:47:49', '2017-05-14 22:47:49');

INSERT INTO `fileupload` (`id`, `filename`, `created_at`, `updated_at`) VALUES
(1, 'LgijtsPIHPTzH5VAwEbhptGZYoYguLOXQ4xzMVnI.png', '2017-05-14 23:13:54', '2017-05-14 23:13:54'),
(2, 'Kw0J1faGOLA3eVbQDMZWl92A0LYCXtJu1GF6Q1JV.png', '2017-05-14 23:13:54', '2017-05-14 23:13:54'),
(3, 'pXGFN10rDINw9USSzsoyRJASmY5nzDQicj6Lqgsl.jpeg', '2017-05-14 23:13:54', '2017-05-14 23:13:54'),
(4, 'uT2f91SnOOzv98E3HPtrZHK8v7CEs10RFvnC6Hvr.jpeg', '2017-05-14 23:13:54', '2017-05-14 23:13:54'),
(5, 'OKEw96JsRGJbJYOWFsXsz1VOqtOrX1ifyaLWECpU.png', '2017-05-14 23:13:54', '2017-05-14 23:13:54'),
(6, 'lC0mTY5KZwt69KkJw559HQBr7ZCfck17TjYhtccg.png', '2017-05-14 23:13:54', '2017-05-14 23:13:54'),
(7, 'gOSw4m55lPDhmofGuSANTzlusRNDLFw5xvHFx4el.jpeg', '2017-05-14 23:13:54', '2017-05-14 23:13:54');

INSERT INTO `order` (`id`, `transportstatus_id`, `user_id`, `code`, `sumnumber`, `sumprice`, `fee`, `promotion`, `totalprice`, `emscode`, `address`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1122334455', 2, '13081.00', '40.00', '0.00', '13121.00', NULL, 'สมจิตร คิดร้าย\r\n123 ถนนพระราม 3 แขวงบางโคล่ เขตบางคอแหลม กรุงเทพมหานคร\r\n10120\r\n09-00000000', NULL, NULL),
(2, 1, 1, 'AABBCCDDEE', 3, '16294.00', '40.00', '500.00', '15834.00', NULL, 'สมจิตร คิดร้าย\r\n123 ถนนพระราม 3 แขวงบางโคล่ เขตบางคอแหลม กรุงเทพมหานคร\r\n10120\r\n09-00000000', NULL, NULL),
(3, 2, 2, '11223344AA', 2, '7218.00', '0.00', '0.00', '7218.00', '123456', 'สมจิตร คิดร้าย\r\n111 ซอยประดู่ 1 ถนนเจริญกรุง แขวงบางคอแหลม เขตบางคอแหลม กรุงเทพมหานคร\r\n10120\r\n09-00000000', NULL, NULL);

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `number`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '5814.00', NULL, NULL),
(2, 1, 2, 1, '7267.00', NULL, NULL),
(3, 2, 5, 2, '5748.00', NULL, NULL),
(4, 2, 8, 1, '4798.00', NULL, NULL),
(5, 3, 7, 2, '3609.00', NULL, NULL);

INSERT INTO `product` (`id`, `category_id`, `code`, `name`, `price`, `balance`, `detail`, `html`, `created_at`, `updated_at`) VALUES
(1, 1, 'ttOA8yWx2B', 'สินค้า 1', '5814.00', 2, 'รายละเอียดสินค้า 1', NULL, '2017-05-14 22:47:49', '2017-05-14 22:47:49'),
(2, 1, '8WZzwtJ3Sl', 'สินค้า 2', '7267.00', 27, 'รายละเอียดสินค้า 2', NULL, '2017-05-14 22:47:49', '2017-05-14 22:47:49'),
(3, 1, '7oyIiQKVeZ', 'สินค้า 3', '5619.00', 21, 'รายละเอียดสินค้า 3', NULL, '2017-05-14 22:47:49', '2017-05-14 22:47:49'),
(4, 2, 'Mo6BUYfhyj', 'สินค้า 4', '3497.00', 98, 'รายละเอียดสินค้า 4', NULL, '2017-05-14 22:47:49', '2017-05-14 22:47:49'),
(5, 2, '8S975laH01', 'สินค้า 5', '5748.00', 22, 'รายละเอียดสินค้า 5', NULL, '2017-05-14 22:47:49', '2017-05-14 22:47:49'),
(6, 3, 'vbdx50rYnP', 'สินค้า 6', '3898.00', 88, 'รายละเอียดสินค้า 6', NULL, '2017-05-14 22:47:49', '2017-05-14 22:47:49'),
(7, 4, 'X5bvDDCxjY', 'สินค้า 7', '3609.00', 52, 'รายละเอียดสินค้า 7', NULL, '2017-05-14 22:47:49', '2017-05-14 22:47:49'),
(8, 9, '974GPriPOY', 'สินค้า 8', '4798.00', 50, 'รายละเอียดสินค้า 8', NULL, '2017-05-14 22:47:50', '2017-05-14 22:47:50'),
(9, 9, '4V73xl11NH', 'สินค้า 9', '7441.00', 80, 'รายละเอียดสินค้า 9', NULL, '2017-05-14 22:47:50', '2017-05-14 22:47:50'),
(10, 6, 'qJI5Ngm9WM', 'สินค้า 10', '2212.00', 100, 'รายละเอียดสินค้า 10', NULL, '2017-05-14 22:47:50', '2017-05-14 22:47:50');

INSERT INTO `product_image` (`id`, `product_id`, `fileupload_id`, `sort`, `statusdefault`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '2017-05-14 23:14:41', '2017-05-14 23:14:41'),
(2, 1, 2, 2, 0, '2017-05-14 23:14:41', '2017-05-14 23:14:41'),
(3, 2, 4, 1, 1, '2017-05-14 23:14:54', '2017-05-14 23:14:54'),
(4, 2, 7, 2, 0, '2017-05-14 23:14:54', '2017-05-14 23:14:54');

INSERT INTO `roles` (`id`, `name`, `detail`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL, NULL),
(2, 'employee', NULL, NULL, NULL);

INSERT INTO `transport_status` (`id`, `name`, `detail`, `created_at`, `updated_at`) VALUES
(1, 'ongoing', 'กำลังดำเนินการ', NULL, NULL),
(2, 'sending', 'กำลังจัดส่ง', NULL, NULL),
(3, 'completed', 'ส่งสินค้าแล้ว', NULL, NULL);

