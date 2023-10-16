-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 16, 2023 lúc 12:01 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dam_cookyfood`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `reset_code` varchar(50) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `email`, `address`, `phone`, `image`, `role`, `deleted`, `reset_code`, `created_at`, `updated_at`) VALUES
(7, 'Admin CiDii', '123456', 'dongcongdinh2018@gmail.com', 'Tứ kỳ, Hải Dương', '0358009111', 'anh-con-vit-cute-8.jpg', 1, 0, '0', '2023-10-03 19:07:33', '2023-10-16 15:43:57'),
(11, 'Client 01', '123456', 'test@gmail.com', 'Hải Dương', '0123213214', '70f5ee91b8880841ad7a637f8c69a10d.jpg', 0, 0, '0', '2023-10-08 17:54:25', '2023-10-08 20:48:09'),
(12, 'Client 02', '123456', 'test2@gmail.com', 'Hà Nội', '0932813128', 'vit3.jpg', 0, 1, '0', '2023-10-08 20:50:56', '2023-10-09 15:10:25'),
(13, 'Phương Anh', '123456', 'anhptpph44915@fpt.edu.vn', 'Hải Dương', '0358009387', 'top-10-bo-phim-dang-xem-nhat-dang-duoc-cho-doi-trong-nua-cuoi-nam-2022-762b919f.jpg', 0, 0, '0', '2023-10-09 16:49:15', '2023-10-10 16:01:03'),
(14, 'Cong Dinh', '123456', 'dongcongdinh2002@gmail.com', 'Hải Dương', '0987162840', 'vit5.jpg', 0, 0, '0', '2023-10-09 20:14:46', '2023-10-10 15:57:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT 0,
  `bill_name` varchar(255) NOT NULL,
  `bill_address` varchar(255) NOT NULL,
  `bill_phone` varchar(50) NOT NULL,
  `bill_note` varchar(255) DEFAULT NULL,
  `bill_email` varchar(100) NOT NULL,
  `bill_pay_method` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1. Thanh toán khi nhận hàng\r\n2. Thanh toán online',
  `order_date` datetime NOT NULL,
  `total` int(10) NOT NULL DEFAULT 0,
  `bill_status` tinyint(1) DEFAULT 0 COMMENT '0. Chờ xác nhận 1. Đang xử lý 2. Đang giao hàng 3. Đã giao hàng 4. Đã hủy 5. Bị hủy bỏ',
  `receive_name` varchar(255) NOT NULL,
  `receive_address` varchar(255) NOT NULL,
  `receive_phone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `bill`
--

INSERT INTO `bill` (`id`, `id_user`, `bill_name`, `bill_address`, `bill_phone`, `bill_note`, `bill_email`, `bill_pay_method`, `order_date`, `total`, `bill_status`, `receive_name`, `receive_address`, `receive_phone`) VALUES
(79, 7, 'cidii_dev202', 'Tứ kỳ, Hải Dương', '0358009111', '', 'dongcongdinh2018@gmail.com', 1, '2023-10-15 00:00:01', 177900, 0, '', '', ''),
(80, 13, 'Phương Anh', 'Hải Dương', '0358009387', '', 'anhptpph44915@fpt.edu.vn', 1, '2023-10-15 16:04:56', 177900, 0, '', '', ''),
(81, 7, 'cidii_dev202', 'Tứ kỳ, Hải Dương', '0358009111', '', 'dongcongdinh2018@gmail.com', 1, '2023-10-15 16:44:12', 45600, 0, '', '', ''),
(82, 13, 'Phương Anh', 'Hải Dương', '0358009387', '', 'anhptpph44915@fpt.edu.vn', 1, '2023-10-15 21:57:02', 77700, 0, '', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `into_money` int(10) NOT NULL,
  `id_bill` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `id_user`, `id_product`, `image`, `name`, `price`, `quantity`, `into_money`, `id_bill`) VALUES
(65, 7, 133, 'lau-3.jpeg', 'Lẩu Thái Hải Sản - Lẩu Nhỏ (Gồm Nước Cốt Lẩu)', 177900, 1, 177900, 79),
(66, 13, 133, 'lau-3.jpeg', 'Lẩu Thái Hải Sản - Lẩu Nhỏ (Gồm Nước Cốt Lẩu)', 177900, 1, 177900, 80),
(67, 7, 34, 'new-8.jpeg', 'Lòng Gà Xào Đậu Que - Xốt Healthy', 45600, 1, 45600, 81),
(68, 13, 51, 'hais-1.jpeg', 'Cá Hú Tươi Làm Sạch Cắt Khúc Đồng Nai', 50100, 1, 50100, 82),
(69, 13, 46, 'heo-8.jpeg', 'Óc Heo Đồng Nai', 27600, 1, 27600, 82);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 'Tất cả', 'groceries.png', '2023-10-02 15:33:02', '2023-10-08 19:33:48', 0),
(36, 'Món Mới', 'mon_moi.png', '2023-09-30 18:06:40', '0000-00-00 00:00:00', 0),
(37, 'Thịt Heo', 'thit_heo.png', '2023-09-30 18:06:50', '0000-00-00 00:00:00', 0),
(38, 'Hải Sản', 'hai_san.gif', '2023-09-30 18:07:00', '0000-00-00 00:00:00', 0),
(39, 'Thịt Bò', 'thit_bo.png', '2023-09-30 18:18:47', '0000-00-00 00:00:00', 0),
(40, 'Rau Củ', 'rau_cu.png', '2023-09-30 18:19:01', '0000-00-00 00:00:00', 0),
(41, 'Gà & Vịt', 'ga&vit.png', '2023-09-30 18:19:16', '0000-00-00 00:00:00', 0),
(42, 'Trứng & Đậu', 'trung&dau.png', '2023-09-30 18:19:32', '0000-00-00 00:00:00', 0),
(43, 'Trái Cây', 'trai_cay.png', '2023-09-30 18:19:45', '0000-00-00 00:00:00', 0),
(44, 'Lương Thực', 'luong_thuc.png', '2023-09-30 18:19:58', '0000-00-00 00:00:00', 0),
(45, 'Lẩu', 'lau.png', '2023-09-30 18:20:07', '0000-00-00 00:00:00', 0),
(46, 'Món Chay', 'mon_chay.png', '2023-09-30 18:20:17', '0000-00-00 00:00:00', 0),
(47, 'Đồ Uống', 'do_uong.png', '2023-09-30 18:20:28', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`id`, `content`, `id_user`, `id_product`, `created_at`) VALUES
(7, 'Sản phẩm chất lượng!!!', 7, 125, '2023-10-09 19:47:04'),
(8, 'Sản phẩm tốt!!!', 14, 125, '2023-10-09 20:15:22'),
(9, 'Sản phẩm tốt', 7, 134, '2023-10-10 10:58:11'),
(10, 'Giao hàng nhanh chóng, món ăn ngon!!! <3', 13, 134, '2023-10-10 16:01:49'),
(11, 'Giao hàng nhanh chóng, ăn rất ngon!!', 11, 134, '2023-10-16 15:40:02'),
(12, 'Sản phẩm tốt', 14, 133, '2023-10-16 15:44:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `discount` int(11) NOT NULL DEFAULT 0,
  `image` varchar(500) NOT NULL,
  `weight` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `discount`, `image`, `weight`, `description`, `view`, `created_at`, `updated_at`, `deleted`, `category_id`) VALUES
(27, 'Cốt Lết Heo CP (Thịt Tươi)', 45000, 38250, 'new-1.jpeg', 300, 'Cốt Lết Heo CP (Thịt Tươi) 300g', 24, '2023-09-30 18:24:36', '2023-09-30 18:24:50', 0, 36),
(28, 'Sườn Non Heo CP (Thịt Tươi)', 79000, 77500, 'new-2.jpeg', 300, 'Sườn Non Heo CP (Thịt Tươi) 300g', 33, '2023-09-30 18:26:11', '2023-09-30 18:32:16', 0, 36),
(29, 'Thịt Heo Xay CP (Thịt Tươi)', 44000, 39600, 'new-3.jpeg', 300, 'Thịt Heo Xay CP (Thịt Tươi) 300g', 0, '2023-09-30 18:33:56', '0000-00-00 00:00:00', 0, 36),
(30, 'Thịt Đùi Heo CP (Thịt Tươi)', 49500, 44550, 'new-4.jpeg', 300, 'Thịt Đùi Heo CP (Thịt Tươi) 300g', 0, '2023-09-30 18:35:01', '0000-00-00 00:00:00', 0, 36),
(31, 'Ba Rọi Heo CP (Thịt Tươi)', 75000, 72700, 'new-5.jpeg', 300, 'Ba Rọi Heo CP (Thịt Tươi) 300g', 44, '2023-09-30 18:36:05', '0000-00-00 00:00:00', 0, 36),
(32, 'Thịt Vai Heo CP (Thịt Tươi)', 44000, 39600, 'new-6.jpeg', 300, 'Thịt Vai Heo CP (Thịt Tươi) 300g', 25, '2023-09-30 18:37:13', '0000-00-00 00:00:00', 0, 36),
(33, 'Nạc Dăm Heo CP (Thịt Tươi)', 55000, 52250, 'new-7.jpeg', 300, 'Nạc Dăm Heo CP (Thịt Tươi) 300g', 0, '2023-09-30 18:38:09', '0000-00-00 00:00:00', 0, 36),
(34, 'Lòng Gà Xào Đậu Que - Xốt Healthy', 48000, 45600, 'new-8.jpeg', 315, '1. Soup Nền Healthy Xào Nước Tương CookyMADE 82g\r\n2. Lòng Gà Làm Sạch 200g\r\n3. Bộ Xào Healthy (Hành Tím, Tỏi Lột, Hành Lá, Ngò Rí) 30g\r\n4. Đậu Que 300g\r\n5. (Lựa chọn) +Cơm Trắng Thơm Lài 300g', 42, '2023-09-30 18:40:01', '2023-09-30 18:57:18', 0, 36),
(35, 'Cá Saba Nhật Kho Thơm - Xốt Healthy', 66000, 62700, 'new-9.jpeg', 925, '1. Thơm (Gọt Sẵn) 150g\r\n2. Soup Nền Healthy Kho Nước Mắm CookyMADE 68g\r\n3. Hành Lá, Ớt Chỉ Thiên Đỏ 15g\r\n4. Cá Saba Nhật Làm Sạch Cắt Khúc 300g\r\n5. (Lựa chọn) +Cơm Trắng Thơm Lài 300g', 21, '2023-09-30 18:41:07', '2023-09-30 18:57:00', 0, 36),
(36, 'Lòng Gà Xào Thơm - Xốt Healthy', 38000, 36100, 'new-10.jpeg', 950, '1. Thơm (Gọt Sẵn) 150g\r\n2. Soup Nền Healthy Xào Nước Tương CookyMADE 82g\r\n3. Lòng Gà Làm Sạch 200g\r\n4. Bộ Xào Healthy (Hành Tím, Tỏi Lột, Hành Lá, Ngò Rí) 30g\r\n5. Hành Tây 50g\r\n6. (Lựa chọn) +Cơm Trắng Thơm Lài 300g', 14, '2023-09-30 18:42:36', '2023-09-30 18:56:01', 0, 36),
(37, 'Set Bò Phô Mai Xốt Hoàng Kim (Nướng Khay Nhôm)', 219000, 208050, 'new-11.jpeg', 550, '1. Xốt Mè Cay Chay CookyMADE 70g\r\n2. Xốt Hoàng Kim CookyMADE 60g\r\n3. Phô Mai Con Bò Cười 2 Miếng\r\n4. Bơ Tường An 30g\r\n5. Nạc Vai Bò Mỹ (Top Blade) Cắt BBQ 200g\r\n6. Dẻ Sườn Bò Nhập Khẩu (Cắt Sẵn) 150g\r\n7. Đậu Bắp 100g\r\n8. Nấm Đùi Gà 100g\r\n9. Trứng Gà 1 Quả\r\n10. Khay Nhôm Nắp Giấy (25.5 x 6cm) - 1 Khay', 0, '2023-09-30 18:43:57', '2023-09-30 18:56:39', 0, 36),
(38, 'Vịt Kho Gừng - Xốt Healthy', 63000, 59850, 'new-12.jpeg', 400, '1. Soup Nền Healthy Kho Nước Mắm CookyMADE 68g\r\n2. Thịt Vịt Xiêm (Chặt Sẵn) 300g\r\n3. Kho Gừng (Gừng Củ Tươi Gọt Sẵn) 30g\r\n4. (Lựa chọn) +Cơm Trắng Thơm Lài 300g\r\n5. (Lựa chọn) +Dừa Xiêm Bến Tre 1 Trái', 0, '2023-09-30 18:45:12', '2023-09-30 18:56:19', 0, 36),
(39, 'Sườn Non Heo Cooky (Thịt Tươi)', 79000, 0, 'heo-1.jpeg', 300, 'Sườn Non Heo Cooky (Thịt Tươi) 300g', 81, '2023-09-30 18:47:04', '2023-10-01 15:01:38', 0, 37),
(40, 'Thịt Đùi Heo Cooky (Thịt Tươi) Đồng Nai', 49500, 10000, 'heo-2.png', 300, 'Thịt Đùi Heo Cooky (Thịt Tươi) 300g', 0, '2023-09-30 18:48:11', '0000-00-00 00:00:00', 0, 37),
(41, 'Ba Rọi Heo Cooky (Thịt Tươi)', 52000, 50000, 'heo-3.jpeg', 200, '1. Ba Rọi Heo Cooky (Thịt Tươi) 200g\r\n2. (Lựa chọn) Ba Rọi Heo Cooky (Thịt Tươi) 300g', 22, '2023-09-30 18:49:08', '0000-00-00 00:00:00', 0, 37),
(42, 'Mọc Viên Nguyên Chất CookyMADE', 39000, 37050, 'heo-4.jpeg', 150, 'Mọc Viên Nguyên Chất CookyMADE 150g', 0, '2023-09-30 18:51:03', '0000-00-00 00:00:00', 0, 37),
(43, 'Ba Rọi Heo Cooky (Thịt Tươi)', 75000, 71500, 'heo-5.png', 300, '1. + [Tặng] Rau Dền 250g\r\n2. Ba Rọi Heo Cooky (Thịt Tươi) 300g\r\n3. (Lựa chọn) + [Tặng] Nấm Kim Châm 150g\r\n4. (Lựa chọn) + [Tặng] Cải Thảo 450g', 0, '2023-09-30 18:52:12', '0000-00-00 00:00:00', 0, 37),
(44, 'Cốt Lết Heo CP (Thịt Tươi)', 45000, 38250, 'heo-6.jpeg', 300, 'Cốt Lết Heo CP (Thịt Tươi) 300g', 18, '2023-09-30 18:53:10', '0000-00-00 00:00:00', 0, 37),
(45, 'Thịt Heo Xay', 15000, 14250, 'heo-7.jpeg', 100, 'Thịt Heo Xay 100g', 0, '2023-09-30 18:54:05', '0000-00-00 00:00:00', 0, 37),
(46, 'Óc Heo Đồng Nai', 29000, 27600, 'heo-8.jpeg', 100, 'Óc Heo (1 Bộ)', 11, '2023-09-30 18:55:19', '0000-00-00 00:00:00', 0, 37),
(47, 'Sườn Non Heo Nhập Khẩu', 49000, 46700, 'heo-9.jpeg', 200, '1. Sườn Non Heo Nhập Khẩu 200g\r\n2. (Lựa chọn) Sườn Non Heo Nhập Khẩu 300g', 9, '2023-09-30 18:59:40', '0000-00-00 00:00:00', 0, 37),
(48, 'Mỡ Heo Có Da (Cắt Sẵn)', 19500, 18000, 'heo-10.jpeg', 300, 'Mỡ Heo Có Da (Cắt Sẵn) 300g', 0, '2023-09-30 19:00:35', '0000-00-00 00:00:00', 0, 37),
(49, '[Heo Úc] Pork Cheek Má Heo', 109000, 105500, 'heo-11.png', 200, '1. [Heo Úc] Pork Cheek Má Heo 200g\r\n2. + [Tặng] Đậu Bắp 250g', 0, '2023-09-30 19:01:35', '0000-00-00 00:00:00', 0, 37),
(50, 'Bao Tử Heo Làm Sạch Đồng Nai', 56000, 53400, 'heo-12.jpeg', 200, 'Bao Tử Heo Làm Sạch 200g', 0, '2023-09-30 19:02:30', '0000-00-00 00:00:00', 0, 37),
(51, 'Cá Hú Tươi Làm Sạch Cắt Khúc Đồng Nai', 52000, 50100, 'hais-1.jpeg', 200, 'Cá Hú Tươi Làm Sạch Cắt Khúc 200g', 63, '2023-09-30 19:04:34', '0000-00-00 00:00:00', 0, 38),
(52, 'Tôm Sú Biển Tươi (Loại 28 - 30 Con/Kg) Vũng Tàu', 349000, 347800, 'hais-2.png', 1000, '1. + [Tặng] Xà Lách Batavia Thuỷ Canh VietGAP 200g\r\n2. + [Tặng] Dưa Leo 500g\r\n3. Tôm Sú Biển Tươi Vũng Tàu (Loại 28 - 30 Con/Kg) 0.95-1Kg\r\n4. (Lựa chọn) + Muối Ớt Xanh CookyMADE 150g - Chai Nhỏ\r\n5. (Lựa chọn) + Muối Ớt Đỏ CookyMADE 150g - Chai Nhỏ\r\n6. (Lựa chọn) + Đóng Thùng Xốp NP9 (31 x 24 x 22cm)', 0, '2023-09-30 19:05:58', '0000-00-00 00:00:00', 0, 38),
(53, 'Tôm Thẻ Tươi - Loại Vừa Đồng Nai', 42000, 10000, 'hais-3.jpeg', 150, '1. Tôm Thẻ Tươi (Loại 40-50 Con/Kg) 150g\r\n2. (Lựa chọn) Tôm Thẻ Tươi (Loại 40-50 Con/Kg) 300g', 0, '2023-09-30 19:06:49', '0000-00-00 00:00:00', 0, 38),
(54, 'Cá Hồi Tươi Phi Lê Na Uy', 169000, 166500, 'hais-4.jpeg', 220, 'Cá Hồi Tươi Phi Lê Na Uy 200-220g', 0, '2023-09-30 19:07:46', '0000-00-00 00:00:00', 0, 38),
(55, 'Combo Hải Sản Nhấp Nháy', 343000, 299000, 'hais-5.png', 500, 'Combo Hải Sản Nhấp Nháy set 3 sản phẩm', 0, '2023-09-30 19:09:25', '0000-00-00 00:00:00', 0, 38),
(56, 'Cá Diêu Hồng Tươi Làm Sạch (Nguyên Con) Đồng Nai', 67000, 65500, 'hais-6.jpeg', 500, '1. Cá Diêu Hồng Tươi Làm Sạch (Nguyên Con) 500g\r\n2. (Lựa chọn) Cá Diêu Hồng Tươi Làm Sạch (Nguyên Con) 600g\r\n3. (Lựa chọn) Cá Diêu Hồng Tươi Làm Sạch (Nguyên Con) 700g', 0, '2023-09-30 19:10:39', '0000-00-00 00:00:00', 0, 38),
(57, 'Mực Ống Nguyên Con 100% Trứng (Loại 16 - 20 Con/Kg) Vũng Tàu', 179000, 176800, 'hais-7.png', 500, '1. + [Tặng] Bộ Xào Chua Ngọt (Hành Tây, Cà Chua, Thơm, Ớt Chuông, Xốt Xào Chua Ngọt CookyMADE,...) 480g\r\n2. Mực Ống 100% Trứng Vũng Tàu (Loại 16 - 20 Con/Kg) 500g\r\n3. (Lựa chọn) + Muối Ớt Xanh CookyMADE 150g - Chai Nhỏ\r\n4. (Lựa chọn) + Muối Ớt Đỏ CookyMADE 150g - Chai Nhỏ\r\n5. (Lựa chọn) + Đóng Thùng Xốp NP9 (31 x 24 x 22cm)', 0, '2023-09-30 19:12:06', '0000-00-00 00:00:00', 0, 38),
(58, 'Cá Chéc 1 Nắng - Loại Vừa', 85000, 82050, 'hais-8.jpeg', 500, 'Cá Chéc Trung (Loại 3 Con/500g)', 0, '2023-09-30 19:13:04', '0000-00-00 00:00:00', 0, 38),
(59, 'Cá Đù Xẻ 1 Nắng - Loại Lớn', 109000, 105000, 'hais-9.jpeg', 500, 'Cá Đù Xẻ Lớn (Loại 3 Con/500g)', 0, '2023-09-30 19:14:00', '0000-00-00 00:00:00', 0, 38),
(60, 'Cá Viên', 22000, 20500, 'hais-10.jpeg', 200, 'Cá Viên 200g', 0, '2023-09-30 19:14:55', '0000-00-00 00:00:00', 0, 38),
(61, 'Cá Rô Phi Fillet Đồng Nai', 38000, 5000, 'hais-11.jpeg', 300, 'Cá Rô Phi Fillet 300g', 0, '2023-09-30 19:16:07', '0000-00-00 00:00:00', 0, 38),
(62, 'Cua Đồng Xay', 26000, 23050, 'hais-12.jpeg', 200, 'Cua Đồng Xay 200g', 0, '2023-09-30 19:17:03', '0000-00-00 00:00:00', 0, 38),
(63, 'Bò Cắt Xào (Thịt Tươi)', 75000, 72100, 'bo-1.jpeg', 250, 'Bò Cắt Xào (Thịt Tươi) 250g', 0, '2023-09-30 19:18:19', '0000-00-00 00:00:00', 0, 39),
(64, '[Bò Úc] Ribeye Đầu Thăn Ngoại Bò', 119000, 110500, 'bo-2.png', 250, '1. [Bò Úc] Ribeye Đầu Thăn Ngoại Bò 250-260g\r\n2. (Lựa chọn) + Rosemary (Hương Thảo) 20g\r\n3. (Lựa chọn) + Măng Tây Xanh 200g\r\n4. (Lựa chọn) + Bơ Tỏi Nướng 100g\r\n5. (Lựa chọn) + Bơ Tỏi Thảo Mộc 100g\r\n6. (Lựa chọn) + Bơ Cafe De Paris Steak 100g\r\n7. (Lựa chọn) + Bơ Lạt 20g\r\n8. (Lựa chọn) +Xốt Tiêu Xanh CookyMADE 60g\r\n9. (Lựa chọn) +Xốt Kem Nấm CookyMADE 60g', 0, '2023-09-30 19:19:54', '0000-00-00 00:00:00', 0, 39),
(65, '[Bò Úc] Chuck Crest Gù Bò (Bò Chăn Thả Tự Nhiên)', 119000, 112000, 'bo-3.png', 250, '1. [Bò Úc] Chuck Crest Gù Bò (Bò Chăn Thả Tự Nhiên) 250g\r\n2. Thịt Bò Cắt Mỏng (Nhúng Lẩu)\r\n3. (Lựa chọn) + Rosemary (Hương Thảo) 20g\r\n4. (Lựa chọn) + Măng Tây Xanh 200g\r\n5. (Lựa chọn) + Bộ Xào Sa Tế (Hành Tây, Hành Tím, Tỏi Tép, Ớt Chỉ Thiên, Hành Lá, Xốt Xào Sa Tế CookyMADE) 120g', 0, '2023-09-30 19:21:02', '0000-00-00 00:00:00', 0, 39),
(66, '[Bò Úc] Combo Nướng Hàn Quốc', 349000, 345000, 'bo-4.png', 300, '1. Combo Nướng Hàn Quốc - 5 Sản Phẩm\r\n2. + [Tặng] Nấm Kim Châm 150g', 0, '2023-09-30 19:22:19', '0000-00-00 00:00:00', 0, 39),
(67, '[Bò Úc] Burger Patty Eco (Bò Chăn Thả Tự Nhiên)', 75000, 73500, 'bo-5.png', 150, '1. [Bò Úc] Burger Patty Eco (Bò Chăn Thả Tự Nhiên) 150g\r\n2. (Lựa chọn) + Xà Lách LoLo Xanh 300g\r\n3. (Lựa chọn) + Cà Chua Đà Lạt 500g', 0, '2023-09-30 19:23:10', '0000-00-00 00:00:00', 0, 39),
(68, '[Bò Úc] Chuck Crest Gù Bò', 109000, 104600, 'bo-6.png', 320, '1. [Bò Úc] Chuck Crest Gù Bò 300 - 320g\r\n2. (Lựa chọn) + Bơ Tỏi Nướng 100g\r\n3. (Lựa chọn) + Bơ Tỏi Thảo Mộc 100g\r\n4. (Lựa chọn) + Bơ Cafe De Paris Steak 100g', 0, '2023-09-30 19:24:07', '0000-00-00 00:00:00', 0, 39),
(69, 'Bắp Bò Nhập Khẩu Cắt Mỏng', 53000, 50500, 'bo-7.png', 200, '1. Bắp Bò Cắt Mỏng Nhập Khẩu 200g\r\n2. (Lựa chọn) Bắp Bò Cắt Mỏng Nhập Khẩu 400g', 0, '2023-09-30 19:25:05', '0000-00-00 00:00:00', 0, 39),
(70, '[Bò Mỹ] Top Blade Nạc Vai Bò', 86000, 82300, 'bo-8.png', 200, '1. Nạc Vai Bò Mỹ (Top Blade) Cắt Steak 200g\r\n2. (Lựa chọn) Nạc Vai Bò Mỹ (Top Blade) Cắt BBQ 200g', 0, '2023-09-30 19:26:02', '0000-00-00 00:00:00', 0, 39),
(71, 'Bò Xay Sẵn', 28500, 25250, 'bo-9.jpeg', 100, 'Bò Xay Sẵn 100g', 0, '2023-09-30 19:26:59', '0000-00-00 00:00:00', 0, 39),
(72, '[Bò Úc] Ribeye Thăn Lưng Bò', 93000, 89900, 'bo-10.png', 200, 'Thăn Lưng Bò (Ribeye) Nhập Khẩu Cắt Steak 200g', 0, '2023-09-30 19:27:56', '0000-00-00 00:00:00', 0, 39),
(73, '[Bò Canada] Shortplate Ba Chỉ Bò', 82000, 79000, 'bo-11.png', 300, 'Ba Chỉ Bò Cắt Mỏng (Nhập Khẩu) 300g', 0, '2023-09-30 19:28:58', '0000-00-00 00:00:00', 0, 39),
(74, '[Bò Canada] Rib Finger Dẻ Sườn Bò (Cắt Sẵn)', 68000, 63400, 'bo-12.jpeg', 150, 'Dẻ Sườn Bò Nhập Khẩu (Cắt Sẵn) 150g', 0, '2023-09-30 19:29:48', '0000-00-00 00:00:00', 0, 39),
(75, 'Thùng Rau Củ 5 Loại', 61000, 59000, 'rau-1.jpeg', 500, 'Thùng Rau Củ 5 Loại (Miễn Phí Bill Trên 300K)', 0, '2023-09-30 19:31:24', '0000-00-00 00:00:00', 0, 40),
(76, 'Bắp Ngọt Giống Mỹ Đồng Nai', 21000, 19500, 'rau-2.jpeg', 200, 'Bắp Ngọt Giống Mỹ 2 Trái', 0, '2023-09-30 19:33:09', '0000-00-00 00:00:00', 0, 40),
(77, 'Sả Cây Đồng Nai', 9000, 5000, 'rau-3.jpeg', 200, 'Sả Cây 200g', 0, '2023-09-30 19:34:22', '0000-00-00 00:00:00', 0, 40),
(78, 'Thùng Rau Gia Vị 5 Loại', 52000, 51500, 'rau-4.jpeg', 500, 'Thùng Rau Gia Vị 5 Loại (Miễn Phí Bill Trên 301K)', 0, '2023-09-30 19:35:22', '0000-00-00 00:00:00', 0, 40),
(79, 'Rau Nấu Canh Chua', 20000, 19000, 'rau-5.png', 395, 'Rau Nấu Canh Chua (Cà Chua, Đậu Bắp, Thơm, Bạc Hà, Giá, Hành Tím, Tỏi, Ngò Om, Ngò Gai, Ớt,...) 395g', 0, '2023-09-30 19:36:41', '0000-00-00 00:00:00', 0, 40),
(80, 'Me Chua Vắt Hộp', 6000, 5000, 'rau-6.jpeg', 60, 'Me Chua Vắt Hộp 60g', 0, '2023-09-30 19:37:31', '0000-00-00 00:00:00', 0, 40),
(81, '(Dùng Ngay) Kim Chi Hàn Quốc CookyMADE', 49000, 46700, 'rau-7.jpeg', 500, 'Kim Chi Hàn Quốc CookyMADE (Dùng Ngay) 500g', 0, '2023-09-30 19:46:44', '0000-00-00 00:00:00', 0, 40),
(82, 'Cải Thìa Xào Nấm Đông Cô', 45000, 40500, 'rau-8.jpeg', 500, '1. Bộ Xào (Hành Tím, Tỏi Lột, Hành Lá, Ngò Rí, Xốt Xào CookyMADE) 60g\r\n2. Cải Thìa VietGAP 300g\r\n3. Nấm Đông Cô Tươi 100g\r\n4. (Lựa chọn) +Cơm Trắng Thơm Lài 300g\r\n5. (Lựa chọn) +Soup Nền Healthy Xào Nước Tương CookyMADE 82g', 0, '2023-09-30 19:47:41', '0000-00-00 00:00:00', 0, 40),
(83, 'Rau Muống Cọng Xào Tỏi', 20000, 18900, 'rau-9.jpeg', 500, '1. Bộ Xào Tỏi (Tỏi Lột, Tỏi Phi, Bột Gia Vị Xào Tỏi CookyMADE) 42g\r\n2. Rau Muống Cọng 200g\r\n3. (Lựa chọn) +Cơm Trắng Thơm Lài 300g', 0, '2023-09-30 19:48:30', '0000-00-00 00:00:00', 0, 40),
(84, 'Su Su Xào Tỏi', 20000, 15500, 'rau-10.jpeg', 400, '1. Bộ Xào Tỏi (Tỏi Lột, Tỏi Phi, Bột Gia Vị Xào Tỏi CookyMADE) 42g\r\n2. Su Su (Cắt Sẵn) 300g\r\n3. (Lựa chọn) +Cơm Trắng Thơm Lài 300g', 0, '2023-09-30 19:49:54', '0000-00-00 00:00:00', 0, 40),
(85, 'Bắp Mỹ Xào Bơ', 44000, 42300, 'rau-11.jpeg', 500, '1. Bộ Xào Bắp (Ruốc Sấy Khô, Bơ Trường An, Hành Lá, Hành Phi, Bột Gia Vị Canh CookyMADE) 93g\r\n2. Bắp Ngọt Giống Mỹ 2 Trái', 0, '2023-09-30 19:50:56', '0000-00-00 00:00:00', 0, 40),
(86, 'Măng Tươi Xào Tỏi', 22000, 20500, 'rau-12.jpeg', 300, '1. Bộ Xào Tỏi (Tỏi Lột, Tỏi Phi, Bột Gia Vị Xào Tỏi CookyMADE) 42g\r\n2. Măng Mạnh Tông Tươi (Cắt Sẵn) 200g\r\n3. (Lựa chọn) +Cơm Trắng Thơm Lài 300g', 0, '2023-09-30 19:52:09', '0000-00-00 00:00:00', 0, 40),
(87, 'Cánh Gà Khúc Giữa Nhập Khẩu Ba Lan', 52000, 49900, 'ga-1.jpeg', 300, 'Cánh Gà Khúc Giữa Nhập Khẩu 300g', 0, '2023-09-30 19:54:03', '0000-00-00 00:00:00', 0, 41),
(88, 'Ức Gà (Thịt Tươi) Đồng Nai', 26000, 24700, 'ga-2.jpeg', 200, 'Ức Gà (Thịt Tươi) 200g', 0, '2023-09-30 19:55:17', '0000-00-00 00:00:00', 0, 41),
(89, 'Đùi Gà Góc Tư Chặt Sẵn (Thịt Tươi)', 32000, 30100, 'ga-3.jpeg', 200, '1. Đùi Gà Góc Tư Chặt Sẵn (Thịt Tươi) 200g\r\n2. (Lựa chọn) Đùi Gà Góc Tư Chặt Sẵn (Thịt Tươi) 300g', 0, '2023-09-30 19:56:05', '0000-00-00 00:00:00', 0, 41),
(90, 'Đùi Gà Phi Lê (Thịt Tươi)', 49000, 10000, 'ga-4.jpeg', 300, 'Đùi Gà Phi Lê (Thịt Tươi) 300g', 0, '2023-09-30 19:56:54', '0000-00-00 00:00:00', 0, 41),
(91, 'Gà Ta Chặt Sẵn (Thịt Tươi) Đồng Nai', 52000, 49400, 'ga-5.jpeg', 300, 'Gà Ta Chặt Sẵn (Thịt Tươi) 300g', 0, '2023-09-30 19:58:37', '0000-00-00 00:00:00', 0, 41),
(92, 'Gà Ta Chặt Sẵn (Thịt Tươi) Đồng Nai', 36000, 33400, 'ga-6.jpeg', 200, '1. Gà Ta Chặt Sẵn (Thịt Tươi) 200g\r\n2. (Lựa chọn) +Lòng Gà Làm Sạch 200g\r\n3. (Lựa chọn) Gà Ta Chặt Sẵn (Thịt Tươi) 300g', 0, '2023-09-30 19:59:24', '0000-00-00 00:00:00', 0, 41),
(93, 'Thịt Vịt Xiêm (Chặt Sẵn) Đồng Nai', 52000, 49400, 'ga-7.jpeg', 300, 'Thịt Vịt Xiêm (Chặt Sẵn) 300g', 0, '2023-09-30 20:00:29', '0000-00-00 00:00:00', 0, 41),
(94, 'Chân Gà Rút Xương', 52000, 50500, 'ga-8.jpeg', 200, 'Chân Gà Rút Xương 200g', 0, '2023-09-30 20:01:17', '0000-00-00 00:00:00', 0, 41),
(95, 'Trứng Non', 29000, 27000, 'ga-9.jpeg', 100, 'Trứng Non 100g', 0, '2023-09-30 20:02:05', '0000-00-00 00:00:00', 0, 41),
(96, 'Đùi Gà Phi Lê Nướng Teriyaki', 72000, 68400, 'ga-10.jpeg', 600, '1. Xốt Teriyaki CookyMADE 60g\r\n2. Đùi Gà Phi Lê (Thịt Tươi) 300g\r\n3. (Lựa chọn) +Cơm Trắng Thơm Lài 300g', 0, '2023-09-30 20:02:58', '0000-00-00 00:00:00', 0, 41),
(97, 'Đùi Gà Góc Tư Kho Sả Ớt', 55000, 53400, 'ga-11.jpeg', 600, '1. Xốt Kho Sả Ớt CookyMADE 60g\r\n2. Đùi Gà Góc Tư Chặt Sẵn (Thịt Tươi) 300g\r\n3. (Lựa chọn) +Cơm Trắng Thơm Lài 300g', 0, '2023-09-30 20:04:06', '0000-00-00 00:00:00', 0, 41),
(98, 'Vịt Kho Gừng', 61000, 59100, 'ga-12.jpeg', 500, '1. Xốt Kho Tộ CookyMADE 60g\r\n2. Thịt Vịt Xiêm (Chặt Sẵn) 300g\r\n3. Kho Gừng (Gừng Củ Tươi Gọt Sẵn) 30g\r\n4. (Lựa chọn) +Cơm Trắng Thơm Lài 300g\r\n5. (Lựa chọn) +Dừa Xiêm Bến Tre 1 Trái\r\n6. (Lựa chọn) Soup Nền Healthy Kho Nước Mắm CookyMADE 68g', 0, '2023-09-30 20:05:02', '0000-00-00 00:00:00', 0, 41),
(99, '4 Quả Trứng Gà', 17000, 15000, 'trung-1.jpeg', 300, 'Trứng Gà 1 Quả x4', 0, '2023-09-30 20:06:49', '0000-00-00 00:00:00', 0, 42),
(100, '10 Quả Trứng Gà', 33500, 31000, 'trung-2.jpeg', 500, 'Trứng Gà 1 Quả x10', 0, '2023-09-30 20:07:37', '0000-00-00 00:00:00', 0, 42),
(101, 'Đậu Hũ Ta Vị Nguyên', 14000, 12300, 'trung-3.jpeg', 280, 'Đậu Hũ Ta Vị Nguyên 280g', 0, '2023-09-30 20:08:22', '0000-00-00 00:00:00', 0, 42),
(102, '30 Quả Trứng Cút', 30000, 28500, 'trung-4.jpeg', 500, 'Trứng Cút 1 Quả x30', 0, '2023-09-30 20:09:15', '0000-00-00 00:00:00', 0, 42),
(103, '10 Quả Trứng Vịt', 48000, 45600, 'trung-5.jpeg', 600, 'Trứng Vịt 1 Quả x10', 0, '2023-09-30 20:10:13', '0000-00-00 00:00:00', 0, 42),
(104, 'Trứng Gà Thảo Dưỡng', 79000, 77100, 'trung-6.jpeg', 500, 'Trứng Gà Thảo Dưỡng 10 Quả', 0, '2023-09-30 20:11:15', '0000-00-00 00:00:00', 0, 42),
(105, 'Tàu Hũ Ky Cọng', 17500, 14900, 'trung-7.jpeg', 150, 'Tàu Hũ Ky Cọng 150g', 0, '2023-09-30 20:12:02', '0000-00-00 00:00:00', 0, 42),
(106, 'Đậu Hũ Nhồi Thịt Xốt Cà', 72000, 68400, 'trung-8.jpeg', 500, '1. Xốt Cà Chua Việt Nam CookyMADE 150g\r\n2. Đậu Hũ Ta Vị Nguyên 280g\r\n3. Hành Lá, Ớt Chỉ Thiên Đỏ 15g\r\n4. Thịt Heo Xay 100g, Giò Sống 50g\r\n5. Bộ Nhồi Thịt (Bún Tàu, Nấm Mèo Khô, Gia Vị Ướp Nhân CookyMADE) 45g\r\n6. (Lựa chọn) +Cơm Trắng Thơm Lài 300g', 0, '2023-09-30 20:13:38', '0000-00-00 00:00:00', 0, 42),
(107, 'Trứng Xào Khổ Qua', 24500, 22000, 'trung-9.jpeg', 400, '1. Bộ Xào Trứng (Hành Tím, Tỏi Lột, Hành Lá, Ngò rí, Bột Gia Vị Xào Tỏi CookyMADE) 42g\r\n2. Khổ Qua (Mướp Đắng) 200g\r\n3. Trứng Gà 1 Quả x2\r\n4. (Lựa chọn) +Cơm Trắng Thơm Lài 300g', 0, '2023-09-30 20:14:31', '0000-00-00 00:00:00', 0, 42),
(108, 'Canh Chua Chay', 49000, 47400, 'trung-10.jpeg', 500, '1. Bột Gia Vị Canh Chua Chay CookyMADE 90g\r\n2. Đậu Hũ Ta Vị Nguyên 280g\r\n3. Rau Nấu Canh Chua (Cà Chua, Đậu Bắp, Thơm, Bạc Hà, Giá, Hành Tím, Tỏi, Ngò Om, Ngò Gai, Ớt,...) 395g\r\n4. (Lựa chọn) +Cơm Trắng Thơm Lài 300g\r\n5. (Lựa chọn) +Me Chua Vắt Hộp 60g\r\n6. (Lựa chọn) +Bún Tươi Sợi Nhỏ Ba Khánh 500g', 0, '2023-09-30 20:15:22', '0000-00-00 00:00:00', 0, 42),
(109, 'Đậu Hũ Chiên Sả Ớt Chay', 27000, 24900, 'trung-11.jpeg', 400, '1. Đậu Hũ Ta Vị Nguyên 280g\r\n2. Bộ Chiên Sả Ớt Chay (Sả Bào, Ớt Chỉ Thiên Đỏ, Gia Vị Chiên Sả Ớt Chay CookyMADE) 71g\r\n3. (Lựa chọn) +Cơm Trắng Thơm Lài 300g', 0, '2023-09-30 20:16:24', '0000-00-00 00:00:00', 0, 42),
(110, '(Dùng Ngay) Trứng Ngâm Tương CookyMADE', 53000, 51500, 'trung-12.jpeg', 700, 'Trứng Ngâm Tương CookyMADE (Dùng Ngay) 4 Trứng', 0, '2023-09-30 20:17:21', '0000-00-00 00:00:00', 0, 42),
(111, 'Dưa Lưới TL3', 52000, 49900, 'trai-1.jpeg', 1100, 'Dưa Lưới TL3 1.1Kg+ (1 Trái)', 0, '2023-09-30 20:18:58', '0000-00-00 00:00:00', 0, 43),
(112, 'Ổi Ruby Ít Hạt Thái Lan', 35000, 33000, 'trai-2.png', 800, 'Ổi Ruby Ít Hạt Thái Lan 800g', 0, '2023-09-30 20:20:01', '0000-00-00 00:00:00', 0, 43),
(113, 'Dưa Hấu Không Hạt Mặt Trời Đỏ', 38000, 35500, 'trai-3.jpeg', 1500, 'Dưa Hấu Không Hạt Mặt Trời Đỏ 1.5Kg+ (Nửa Trái)', 0, '2023-09-30 20:21:01', '0000-00-00 00:00:00', 0, 43),
(114, 'Cóc Non', 25000, 22000, 'trai-4.jpeg', 1000, '1. Cóc Non 1Kg\r\n2. Gói Muối Tôm Tây Ninh 10g', 0, '2023-09-30 20:23:03', '2023-09-30 20:23:39', 0, 43),
(115, 'Chuối Cau (Nguyên Nải)', 35000, 32500, 'trai-5.png', 1100, '1. Chuối Cau (Nguyên Nải) 1.1Kg+\r\n2. (Lựa chọn) Chuối Xanh (2-3 Ngày Sẽ Chín)\r\n3. (Lựa chọn) Chuối Cau (Nguyên Nải) 1.3Kg+\r\n4. (Lựa chọn) Chuối Cau (Nguyên Nải) 1.8Kg+', 0, '2023-09-30 20:24:37', '0000-00-00 00:00:00', 0, 43),
(116, 'Táo Gala New Zealand', 59000, 57400, 'trai-6.jpeg', 600, 'Táo Gala New Zealand 600g', 0, '2023-09-30 20:27:27', '0000-00-00 00:00:00', 0, 43),
(117, 'Nho Xanh Mỹ Không Hạt', 109000, 106100, 'trai-7.jpeg', 300, '1. Nho Xanh Mỹ Không Hạt 300g\r\n2. (Lựa chọn) Nho Xanh Mỹ Không Hạt 0.8Kg', 0, '2023-09-30 20:29:19', '0000-00-00 00:00:00', 0, 43),
(118, 'Củ Sắn (Củ Đậu) Đồng Nai', 25000, 23400, 'trai-8.jpeg', 1000, 'Củ Sắn (Củ Đậu) 1Kg', 0, '2023-09-30 20:30:16', '0000-00-00 00:00:00', 0, 43),
(119, 'Xoài Tứ Quý', 55200, 52000, 'trai-9.jpeg', 1200, 'Xoài Tứ Quý 1.1-1.2Kg', 0, '2023-09-30 20:31:26', '0000-00-00 00:00:00', 0, 43),
(120, 'Trái Cây Thập Cẩm Theo Mùa', 35000, 30500, 'trai-10.jpeg', 500, 'Trái Cây Thập Cẩm Theo Mùa 500g', 0, '2023-09-30 20:32:18', '0000-00-00 00:00:00', 0, 43),
(121, 'Nước Ép Cam Sành Nguyên Chất', 25000, 22500, 'trai-11.jpeg', 330, '1. Không Đường\r\n2. Nước Ép Cam Sành Nguyên Chất 330Ml\r\n3. (Lựa chọn) Nước Đường Hàn Quốc Deasang 20Ml', 0, '2023-09-30 20:34:09', '0000-00-00 00:00:00', 0, 43),
(122, 'Sữa Chua Nhiệt Đới', 32000, 30100, 'trai-12.jpeg', 415, 'Sữa Chua Nhiệt Đới 415g', 0, '2023-09-30 20:35:13', '0000-00-00 00:00:00', 0, 43),
(123, 'Bún Gạo Xào Bắp Bò', 70000, 67400, 'luong-1.jpeg', 700, '1. Bún Gạo 100g\r\n2. Bộ Xào (Hành Tím, Tỏi Lột, Hành Lá, Ngò Rí, Xốt Xào CookyMADE) 60g\r\n3. Rau Xào (Cải Thìa, Cải Thảo, Hành Tây) 100g\r\n4. Bắp Bò Cắt Mỏng Nhập Khẩu 200g\r\n5. (Lựa chọn) +Cơm Trắng Thơm Lài 300g', 0, '2023-09-30 20:36:37', '0000-00-00 00:00:00', 0, 44),
(124, 'Bánh Canh Mọc Viên', 99000, 97300, 'luong-2.jpeg', 800, '1. Mọc Viên Nguyên Chất CookyMADE 150g\r\n2. Nước Hầm Xương Heo CookyMADE 500g\r\n3. Bánh Canh Gạo Ba Khánh 500g\r\n4. Bộ Bánh Canh (Cà Rốt, Củ Cải Trắng, Hành Lá, Ngò Rí, Hành Phi) 240g', 0, '2023-09-30 20:39:14', '0000-00-00 00:00:00', 0, 44),
(125, 'Bún Mọc', 107000, 104100, 'luong-3.jpeg', 900, '1. Mọc Viên Nguyên Chất CookyMADE 150g\r\n2. Nước Hầm Xương Heo CookyMADE 500g\r\n3. Bún Tươi Sợi Nhỏ Ba Khánh 500g\r\n4. Rau Bún Mọc (Giá Đỗ, Bắp Chuối Bào, Xà Lách Lolo Xanh, Hành Lá, Ngò Rí, Hành Phi) 180g', 0, '2023-09-30 20:40:24', '0000-00-00 00:00:00', 0, 44),
(126, 'Bún Thịt Heo Xào', 105000, 101000, 'luong-4.jpeg', 1100, '1. Nước Mắm Chua Ngọt CookyMADE 150g\r\n2. Bún Tươi Sợi Nhỏ Ba Khánh 500g\r\n3. Bộ Bún Tươi (Giá Đỗ, Dưa Leo, Xà Lách Lolo Xanh, Húng Quế, Hành Lá,...) 320g\r\n4. Bộ Thịt Xào (Hành Tím Lột, Tỏi Tép Lột, Hành Tây, Xốt Xào CookyMADE) 150g\r\n5. Nạc Dăm Heo Cooky (Thịt Tươi) 300g', 0, '2023-09-30 20:41:20', '0000-00-00 00:00:00', 0, 44),
(127, 'Bún Gạo Xào Hải Sản', 96000, 94700, 'luong-5.jpeg', 600, '1. Bún Gạo 100g\r\n2. Rau Xào (Cải Thìa, Cải Thảo, Hành Tây) 100g\r\n3. Bộ Xào (Hành Tím, Tỏi Lột, Hành Lá, Ngò Rí, Xốt Xào CookyMADE) 60g\r\n4. Combo Mực & Tôm Thẻ 200g\r\n5. (Lựa chọn) +Cơm Trắng Thơm Lài 300g', 0, '2023-09-30 20:43:28', '0000-00-00 00:00:00', 0, 44),
(128, 'Bún Nước Tương', 66000, 64100, 'luong-6.jpeg', 600, '1. Nước Tương Chua Ngọt Tỏi Ớt CookyMADE 150g\r\n2. Bún Tươi Sợi Nhỏ Ba Khánh 500g\r\n3. Đậu Hũ Ta Vị Nguyên 280g\r\n4. Đậu Phộng Rang 20g\r\n5. Rau Bún (Giá Đỗ, Dưa Leo, Xà Lách LoLo Xanh, Húng Quế) 270g', 0, '2023-09-30 20:44:16', '0000-00-00 00:00:00', 0, 44),
(129, 'Bún Cá', 116000, 112300, 'luong-7.jpeg', 1200, '1. Hành Phi 20g\r\n2. Nước Hầm Xương Heo CookyMADE 500g\r\n3. Húng Quế 30g\r\n4. Sả Cây 50g\r\n5. Bún Tươi Sợi Nhỏ Ba Khánh 500g\r\n6. Rau Bún Cá (Cà Chua, Thơm Gọt Sẵn, Bắp Chuối Bào, Xà Lách Lolo Xanh) 400g\r\n7. Hành Tím, Tỏi Tép Lột Sẵn 20g\r\n8. Hành Lá, Ngò Rí 20g\r\n9. Cá Rô Làm Sạch Cắt Khúc 300g', 0, '2023-09-30 20:45:27', '2023-10-02 17:18:20', 0, 44),
(130, 'Bún Riêu Chay', 119000, 115700, 'luong-8.png', 900, '1. Nước Hầm Rau Củ CookyMADE 500g\r\n2. Bún Tươi Sợi Nhỏ Ba Khánh 500g\r\n3. Đậu Hũ Ta Vị Nguyên 280g\r\n4. Bộ Rau Bún Riêu (Rau Muống Cọng, Bắp Chuối Bào, Húng Quế, Giá) 230g\r\n5. Bộ Nấu Bún Riêu Chay (Nấm Đùi Gà, Nấm Đông Cô, Cà Chua, Hành Baro, Mắm Ruốc Chay,...) 470g', 0, '2023-09-30 20:46:35', '0000-00-00 00:00:00', 0, 44),
(131, 'Lẩu Nấm Hải Sản (Gồm Nước Cốt Lẩu)', 269000, 259900, 'lau-1.jpeg', 2000, '1. Hành Phi 20g\r\n2. Nước Hầm Xương Heo CookyMADE 500g\r\n3. Nước Chấm (Nước Mắm, Ớt Chỉ Thiên) 40g\r\n4. Bún Tươi Sợi Nhỏ Ba Khánh 500g\r\n5. Rau Lẩu Nấm (Nấm Linh Chi, Nấm Đùi Gà, Nấm Kim Châm, Nấm Bào Ngư, Cải Thìa, Hành Tây, Hành Lá) 645g\r\n6. Bộ Hải Sản Thả Lẩu (Tôm Thẻ, Mực, Cá Viên, Cá Hú) 470g\r\n7. Thùng Carton (35 x 25 x 15cm) - 1 Thùng\r\n8. (Lựa chọn) +Tôm Thẻ Tươi (Loại 40-50 Con/Kg) 150g\r\n9. (Lựa chọn) +Mực Nang Làm Sạch 200g\r\n10. (Lựa chọn) +Mực Lá Lớn Làm Sạch 200g\r\n11. (Lựa chọn) +Cá Hú Tươi Làm Sạch Cắt Khúc 200g\r\n12. (Lựa chọn) +Cá Viên Aqua CP 500g\r\n13. (Lựa chọn) +Lẩu Thả Long Cung Cầu Tre 300g\r\n14. (Lựa chọn) +Thanh Cua Arika 250g\r\n15. (Lựa chọn) +Rau Lẩu Nấm (Nấm Linh Chi, Nấm Đùi Gà, Nấm Kim Châm, Nấm Bào Ngư, Cải Thìa, Hành Tây, Hành Lá) 645g\r\n16. (Lựa chọn) +Bún Tươi Sợi Nhỏ Ba Khánh 500g', 0, '2023-09-30 20:49:37', '0000-00-00 00:00:00', 0, 45),
(132, 'Lẩu Nấm Tiêu Xanh Chay', 156000, 154300, 'lau-2.jpeg', 1900, '1. Nước Hầm Rau Củ CookyMADE 500g\r\n2. Bún Tươi Sợi Nhỏ Ba Khánh 500g\r\n3. Đậu Hũ Ta Vị Nguyên 280g\r\n4. Lẩu Nấm Tiêu Xanh (Mướp Hương, Mồng Tơi, Cải Bẹ Xanh, Nâm Kim Châm, Nấm Đùi Gà, Nấm Bào Ngư) 750g\r\n5. Rau Củ Nấu Nước Dùng Lẩu (Hành Lá, Hành Tây, Củ Cải Trắng, Tiêu Xanh) 185g\r\n6. Chả Cá Chay 100g\r\n7. Thùng Carton (35 x 25 x 15cm) - 1 Thùng\r\n8. (Lựa chọn) +Chả Cá Chay 100g\r\n9. (Lựa chọn) +Bún Tươi Sợi Nhỏ Ba Khánh 500g', 0, '2023-09-30 20:50:49', '0000-00-00 00:00:00', 0, 45),
(133, 'Lẩu Thái Hải Sản - Lẩu Nhỏ (Gồm Nước Cốt Lẩu)', 179000, 177900, 'lau-3.jpeg', 2000, '1. Nước Chấm (Nước Mắm, Ớt Chỉ Thiên) 40g\r\n2. Bún Tươi Sợi Nhỏ Ba Khánh 500g\r\n3. Bộ Rau Ăn Kèm Lẩu Chua (Rau Muống Cọng, Kèo Nèo, Bắp Chuối Bào, Nấm Kim Châm) 350g\r\n4. Bộ Nấu Lẩu Chua Cay (Củ Riềng, Sả Cây, Hành Tây, Cà Chua, Húng Quế, Ngò Gai, Xốt Tomyum) 640g\r\n5. Combo Mực & Tôm Thẻ 200g\r\n6. Thùng Carton (35 x 25 x 15cm) - 1 Thùng\r\n7. (Lựa chọn) +Combo Mực & Tôm Thẻ 200g\r\n8. (Lựa chọn) +Mực Nang Làm Sạch 200g\r\n9. (Lựa chọn) +Mực Lá Lớn Làm Sạch 200g\r\n10. (Lựa chọn) +Bún Tươi Sợi Nhỏ Ba Khánh 500g\r\n11. (Lựa chọn) +Bộ Rau Ăn Kèm Lẩu Chua Nhỏ (Rau Muống Cọng, Kèo Nèo, Bắp Chuối Bào, Nấm Kim Châm) 350g', 0, '2023-09-30 20:51:45', '0000-00-00 00:00:00', 0, 45),
(134, 'Lẩu Thái Bò - Lẩu Nhỏ', 149000, 0, 'lau-4.jpeg', 900, '1. Nước Chấm (Nước Mắm, Ớt Chỉ Thiên) 40g\r\n2. Bún Tươi Sợi Nhỏ Ba Khánh 500g\r\n3. Bộ Rau Ăn Kèm Lẩu Chua (Rau Muống Cọng, Kèo Nèo, Bắp Chuối Bào, Nấm Kim Châm) 350g\r\n4. Bộ Nấu Lẩu Chua Cay (Củ Riềng, Sả Cây, Hành Tây, Cà Chua, Húng Quế, Ngò Gai, Xốt Tomyum) 640g\r\n5. Bắp Bò Cắt Mỏng Nhập Khẩu 200g\r\n6. Thùng Carton (35 x 25 x 15cm) - 1 Thùng\r\n7. (Lựa chọn) +Bắp Bò Nhập Khẩu Cắt Mỏng 200g\r\n8. (Lựa chọn) +Bún Tươi Sợi Nhỏ Ba Khánh 500g\r\n9. (Lựa chọn) +Bộ Rau Ăn Kèm Lẩu Chua Nhỏ (Rau Muống Cọng, Kèo Nèo, Bắp Chuối Bào, Nấm Kim Châm) 350g', 0, '2023-09-30 20:52:56', '2023-10-04 16:12:34', 0, 45);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lk_cart_product` (`id_product`),
  ADD KEY `lk_cart_account` (`id_user`),
  ADD KEY `lk_cart_bill` (`id_bill`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lk_comment_account` (`id_user`),
  ADD KEY `lk_comment_product` (`id_product`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lk_product_category` (`category_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `lk_cart_account` FOREIGN KEY (`id_user`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `lk_cart_bill` FOREIGN KEY (`id_bill`) REFERENCES `bill` (`id`),
  ADD CONSTRAINT `lk_cart_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `lk_comment_account` FOREIGN KEY (`id_user`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `lk_comment_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `lk_product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
