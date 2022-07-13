-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 09, 2019 lúc 05:15 AM
-- Phiên bản máy phục vụ: 10.4.8-MariaDB
-- Phiên bản PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `tesstmai`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `userName` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `psw` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `fullName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `permission` int(11) NOT NULL DEFAULT 0,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` char(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id`, `userName`, `psw`, `fullName`, `email`, `birth`, `created`, `permission`, `address`, `phone`) VALUES
(1, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 'Tống Việt Huỳnh Mai', 'tvh.mai.us@gmail.com', '1998-08-13', '2019-11-22 20:19:30', 1, 'Q1', '113'),
(2, 'admin2', '202cb962ac59075b964b07152d234b70', 'Nguyễn Văn A', 'asd', '2019-11-15', '2019-11-23 09:58:38', 0, 'asd', 'asd'),
(6, 'admin3', '202cb962ac59075b964b07152d234b70', 'Nguyễn Văn A', 'abc@gamil.com', '2019-05-11', '2019-11-23 10:05:46', 0, 'Q1', '113'),
(7, 'congchuabongbong', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, '2019-11-25 01:50:22', 0, NULL, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detailorder`
--

CREATE TABLE `detailorder` (
  `idOrder` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `money` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `detailorder`
--

INSERT INTO `detailorder` (`idOrder`, `idProduct`, `amount`, `money`) VALUES
(1, 61, 1, 240000),
(1, 63, 2, 130000),
(1, 66, 1, 145000),
(2, 64, 1, 15000),
(2, 65, 1, 30000),
(2, 66, 1, 145000),
(2, 67, 1, 65000),
(2, 68, 1, 65000),
(3, 67, 2, 65000),
(4, 68, 1, 65000),
(5, 67, 1, 65000),
(6, 64, 1, 15000),
(7, 62, 1, 100000),
(8, 65, 2, 30000),
(9, 63, 1, 65000),
(10, 65, 1, 30000),
(11, 64, 1, 15000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` char(12) COLLATE utf8_unicode_ci NOT NULL,
  `fullName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `totalMoney` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `customer`, `created`, `address`, `phone`, `fullName`, `totalMoney`) VALUES
(1, 2, '2019-12-09 00:59:33', 'asd', 'asd', 'Nguyễn Văn A', 515000),
(2, 2, '2019-12-09 04:09:09', 'asd', 'asd', 'Nguyễn Văn A', 320000),
(3, 2, '2019-12-09 04:09:32', 'asd', 'asd', 'Nguyễn Văn A', 130000),
(4, 2, '2019-12-09 04:09:45', 'asd', 'asd', 'Nguyễn Văn A', 65000),
(5, 2, '2019-12-09 04:09:55', 'asd', 'asd', 'Nguyễn Văn A', 65000),
(6, 2, '2019-12-09 04:10:06', 'asd', 'asd', 'Nguyễn Văn A', 15000),
(7, 2, '2019-12-09 04:10:19', 'asd', 'asd', 'Nguyễn Văn A', 100000),
(8, 2, '2019-12-09 04:10:34', 'asd', 'asd', 'Nguyễn Văn A', 60000),
(9, 2, '2019-12-09 04:10:49', 'asd', 'asd', 'Nguyễn Văn A', 65000),
(10, 2, '2019-12-09 04:11:04', 'asd', 'asd', 'Nguyễn Văn A', 30000),
(11, 2, '2019-12-09 04:11:18', 'asd', 'asd', 'Nguyễn Văn A', 15000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `idType` int(11) NOT NULL,
  `img` char(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `description`, `amount`, `idType`, `img`) VALUES
(22, 'Ví', 51000, 'Size: 16.5*12cm - Test sửa sp', 10, 6, '9.jpg'),
(25, 'Hộp nhựa', 95000, 'Size: 18.5*12.5*10cm', 20, 5, '16.jpg'),
(26, 'Gấu bông siêu mềm mịn', 95000, '', 10, 1, '19.jpg'),
(27, 'Heo bông kèm phụ kiện', 155000, '', 10, 1, '20.jpg'),
(28, 'Nệm lót lưng/ mông', 55000, 'có dây định 4 góc', 30, 1, '21.jpg'),
(29, 'Vịt bông', 315000, '', 10, 1, '22.jpg'),
(30, 'Giấy notes', 20000, '', 30, 2, '14.jpg'),
(31, 'Vòng tay', 65000, '', 0, 7, '11.jpg'),
(32, '2lines pen', 100000, 'set 6 cây', 20, 2, '10.jpg'),
(33, 'Ví hologram', 115000, '', 10, 6, '17.jpg'),
(35, 'Cài tóc', 55000, '', 10, 7, '4.jpg'),
(36, 'Móc khóa', 25000, '', 20, 5, 'mk1.jpg'),
(37, 'Lịch để bàn', 35000, '', 20, 2, 'tl1.jpg'),
(38, 'Túi nhựa tiện lợi', 65000, '', 10, 6, 't1.jpg'),
(39, 'Balo', 325000, '', 10, 6, '23.jpg'),
(44, 'Kẹp/uốn tóc', 95000, '', 30, 4, '8.jpg'),
(45, 'Túi chườm', 65000, '', 10, 5, '12.jpg'),
(56, 'Mũ lưỡi trai', 65000, '', 20, 7, '18.jpg'),
(57, 'Ví Unicorn', 95000, '', 20, 6, '2.jpg'),
(58, 'Gương', 65000, '', 10, 7, '5.jpg'),
(59, 'Gương hai mặt', 115000, '', 10, 7, '7.jpg'),
(60, 'Bình nước (450ml)', 85000, '', 20, 5, 'bn1.jpg'),
(61, 'Bình nước (890ml)', 240000, '', 10, 5, 'bn2.jpg'),
(62, 'Hợp cơm nhựa', 100000, '', 20, 5, 'hn1.jpg'),
(63, 'Bút dạ 6 màu', 65000, 'set 6 cây', 20, 2, 'pen2.jpg'),
(64, 'Giấy notes', 15000, '', 10, 2, 'note.jpg'),
(65, 'Bìa đựng tài liệu', 30000, '', 30, 2, 'bia.jpg'),
(66, 'Gối kê cổ', 145000, '', 20, 1, 'goi.jpg'),
(67, 'Dây chuyền', 65000, '', 10, 7, 'dc.jpg'),
(68, 'Kit du lịch', 65000, '', 10, 5, '13.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Gấu bông và gối'),
(2, 'Văn phòng phẩm'),
(4, 'Thiết bị điện tử'),
(5, 'Đồ dùng tiện ích'),
(6, 'Túi và ví'),
(7, 'Trang điểm');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `detailorder`
--
ALTER TABLE `detailorder`
  ADD PRIMARY KEY (`idOrder`,`idProduct`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer` (`customer`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idType` (`idType`);

--
-- Chỉ mục cho bảng `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT cho bảng `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `detailorder`
--
ALTER TABLE `detailorder`
  ADD CONSTRAINT `detailorder_ibfk_1` FOREIGN KEY (`idOrder`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `detailorder_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `account` (`id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`idType`) REFERENCES `type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
