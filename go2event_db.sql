
USE go2event_db;


INSERT INTO `roles` (`id_role`, `name_role`) VALUES
(1, 'admin'),
(2, 'client'),
(3, 'unsuscribed');

INSERT INTO `users` (`id_user`, `id_role`, `email`, `name`, `surname`, `pass`) VALUES
(1, 1, 'admin@admin', 'Root', 'Casi Master of the Universe', '$2y$10$LoXVkSa62nQTtvTnfQN9EudP25rpfPxWvhubr2lErJo7z70AdSQui'),
(2, 2, 'cliente@cliente', 'Simple', 'Peasant', '$2y$10$mrG95dhyFQchG7BhL7ya5u.7goe0W.YJU/etqmb3bZXVT6BWYrDTu');

INSERT INTO `artists` (`id_artist`, `name_artist`, `description`, `active`) VALUES
(1, 'AC/DC', 'asd', 1),
(2, 'Arctic Monkeys', 'asd', 1),
(3, 'Aerosmith', 'asd', 1),
(4, 'Attaque 77', 'asd', 1),
(5, 'Avenged Sevenfold', 'asd', 1),
(6, 'Blink-182', 'asd', 1),
(7, 'Busty and the Bass', 'asd', 1),
(8, 'Carajo', 'asd', 1),
(9, 'Ciro y los Persas', 'asd', 1),
(10, 'Cuatro Pesos de Propina', 'asd', 1),
(11, 'Dead Poet Society', 'asd', 1),
(12, 'Deep Purple', 'asd', 1),
(13, 'Divididos', 'asd', 1),
(14, 'El Kuelgue', 'asd', 1),
(15, 'El Plan de la Mariposa', 'asd', 1),
(16, 'Eruca Sativa', 'asd', 1),
(17, 'Foo Fighters', 'asd', 1),
(18, 'Gorillaz', 'asd', 1),
(19, 'Greta Van Fleet', 'asd', 1),
(20, 'Harm & Ease', 'asd', 1),
(21, 'Imagine Dragons', 'asd', 1),
(22, 'Queens of the Stone Age', 'asd', 1),
(23, 'Jeites', 'asd', 1),
(24, 'John Mayer', 'asd', 1),
(25, 'Kings of Leon', 'asd', 1),
(26, 'Limp Bizkit', 'asd', 1),
(27, 'Mustafunk', 'asd', 1),
(28, 'No te va a Gustar', 'asd', 1),
(29, 'Paramore', 'asd', 1),
(30, 'Octafonic', 'asd', 1),
(31, 'Roger Waters', 'asd', 1),
(32, 'Stone Temple Pilots', 'asd', 1),
(33, 'Trivium', 'asd', 1),
(34, 'Virtual Frizz', 'asd', 1),
(35, 'Winery Dogs', 'asd', 1),
(36, 'Les Luthiers', 'asd', 1),
(37, 'Midachi', 'asd', 1),
(38, 'Coldplay', 'asd', 1);
 

INSERT INTO `categories` (`id_category`, `name_category`, `active`) VALUES
(1, 'Recital', 1),
(2, 'Festival', 1),
(3, 'Obra de Teatro', 1);

INSERT INTO `venues` (`id_venue`, `name_venue`, `address`, `city`, `capacityLimit`, `active`) VALUES
(1, 'Estadio GEBA', 'Calle Falsa 123', 'CABA', 12000, 1),
(2, 'Estadio JosÃ© Maria Minella', 'Calle Falsa 321', 'Mar del Plata', 35000, 1),
(3, 'Estadio Antonio Vespucio Liberti', 'Calle Falsa 951', 'CABA', 75000, 1),
(4, 'Teatro Gran Rex', 'Calle Falsa 753', 'CABA', 3000, 1),
(5, 'Teatro ColÃ³n', 'Calle Falsa 482', 'CABA', 3500, 1),
(6, 'Estadio JosÃ© Amalfitani', 'Calle Falsa 682', 'Liniers', 50000, 1),
(7, 'Hipodromo de Palermo', 'Calle Falsa 645', 'CABA', 50000, 1);

INSERT INTO `events` (`id_event`, `name_event`, `description`, `img_path`, `id_category`, `active`) VALUES
(1, 'Us + Them World Tour', 'Us + Them Tour es una gira musical del mÃºsico britÃ¡nico Roger Waters. La gira comenzÃ³ el 21 de mayo de 2017 con un concierto en la ciudad de East Rutherford. El tour tiene la finalidad de promocionar el nuevo disco de Water titulado Is This the Life We Really Want? ', 'meta.jpg', 1, 1),
(2, 'Lollapalooza Argentina', 'Lollapalooza es un festival musical de los Estados Unidos que originalmente ofrecÃ­a bandas de rock alternativo, indie y punk rock; tambiÃ©n hay actuaciones cÃ³micas y de danza. Concebido en 1991 por Perry Farrell, cantante de Jane\'s Addiction, Lollapalooza se realizÃ³ anualmente hasta 1997 y fue re', '5.jpg', 2, 1),
(3, 'Gran Reserva', 'Les Luthiers Gran Reserva es una  antologÃ­a que reÃºne, renovados, grandes Ã©xitos de su historia, con obras memorables como â€œLa Balada del 7Âº Regimientoâ€, â€œSan IctÃ­cola de los Pecesâ€, â€œEntreteniciencia Familiarâ€, â€œLa Hora de la Nostalgiaâ€, â€œQuiÃ©n Conociera a MarÃ­aâ€, el bole', 'les-luthiers.jpg', 3, 1),
(4, 'Kindon', 'Dady Brieva, Miguel del Sel y el Chino Volpato, el trÃ­o mÃ¡s cÃ³mico de la Argentina, desembarcan el 9 de agosto en Calle Corrientes para celebrar sus primeros 35 aÃ±os juntos. Luego de 7 aÃ±os, el trÃ­o volviÃ³ a reunirse en una nueva superproducciÃ³n que lleva ya mÃ¡s de 250.000 entradas vendidas', 'midachi.png', 3, 1),
(5, 'Rock or Bust World Tour', 'Rock or Bust es el decimosexto Ã¡lbum de la banda de hard rock australiana AC/DC. Fue lanzado internacionalmente como decimoquinto Ã¡lbum de estudio de la banda y el decimosexto que se publica en Australia. Es el Ã¡lbum de estudio mÃ¡s corto jamÃ¡s lanzado por la banda; con menos de 35 minutos. ', 'maxresdefault.jpg', 1, 1),
(6, 'A Head Full of Dreams', 'A Head Full of Dreams Tour es la sÃ©ptima gira de conciertos de la banda de rock britÃ¡nica Coldplay. Se mostrarÃ¡ el material de su reciente sÃ©ptimo Ã¡lbum de estudio, A Head Full of Dreams', '$_86.JPG', 1, 1),
(7, 'Rock \'N Roll Rumble', 'Una de las emblemÃ¡ticas bandas dar rock de todos los tiempos es Aerosmith, quien en su gira de despedida incluye a MÃ©xico uniÃ©ndose al rocktubre con un concierto imperdible para sus seguidores. â€œRock \'N Roll Rumble Aerosmith Styleâ€ trae a todos los miembros originales de la banda, Steven Tyle', 'Aerosmithcolectivosonorocom.jpg', 1, 1),
(8, 'Anthem of the Peaceful Army', 'Anthem of the Peaceful Army es el Ã¡lbum de estudio de debut de la banda de rock estadounidense Greta Van Fleet. El Ã¡lbum fue lanzado el 19 de octubre de 2018, y sigue los dos lanzamientos originales de la banda, Black Smoke Rising y From the Fires. El primer single, \"When the Curtain Falls\", fue l', 'gretavanfleetartwork.jpg', 1, 1);

INSERT INTO `seattypes` (`id_seattype`, `name_seattype`, `description`, `active`) VALUES
(1, 'Campo', 'asd', 1),
(2, 'Campo VIP', 'asd', 1),
(3, 'Platea', 'asd', 1),
(4, 'General', 'asd', 1),
(5, 'Pullman', 'asd', 1);

INSERT INTO `calendars` (`id_calendar`, `date_calendar`, `img_path`, `id_venue`, `id_event`, `active`) VALUES
(1, '2018-11-30 00:00:00', NULL, 3, 1, 1),
(2, '2018-11-30 00:00:00', NULL, 4, 3, 1),
(3, '2018-12-01 00:00:00', NULL, 3, 3, 1),
(4, '2018-12-02 00:00:00', NULL, 3, 3, 1),
(5, '2018-12-08 00:00:00', NULL, 3, 4, 1),
(6, '2019-03-29 00:00:00', NULL, 7, 2, 1),
(7, '2018-12-15 00:00:00', NULL, 3, 5, 1),
(8, '2018-12-28 00:00:00', NULL, 6, 6, 1),
(9, '2018-12-07 00:00:00', NULL, 2, 7, 1),
(10, '2018-12-16 00:00:00', NULL, 3, 8, 1),
(11, '2018-12-17 00:00:00', NULL, 3, 8, 1),
(12, '2019-03-30 00:00:00', NULL, 7, 2, 1);


INSERT INTO `artists_x_calendar` (`id_artist`, `id_calendar`) VALUES
(1, 7),
(2, 6),
(2, 12),
(3, 9),
(4, 6),
(4, 12),
(5, 6),
(5, 12),
(6, 6),
(6, 12),
(7, 12),
(8, 6),
(8, 12),
(9, 12),
(10, 6),
(10, 12),
(11, 6),
(13, 6),
(13, 12),
(14, 6),
(14, 12),
(15, 12),
(16, 6),
(19, 10),
(19, 11),
(19, 12),
(20, 6),
(22, 6),
(23, 6),
(23, 12),
(25, 12),
(26, 6),
(27, 6),
(27, 12),
(28, 12),
(29, 12),
(30, 6),
(31, 1),
(32, 6),
(34, 6),
(35, 6),
(35, 12),
(36, 2),
(36, 3),
(36, 4),
(37, 5),   
(38, 8);


INSERT INTO `seats` (`id_seat`, `quant`, `price`, `remaining`, `id_seattype`, `id_calendar`, `active`) VALUES
(1, 30000, 2000, 30000, 1, 1, 1),
(2, 10000, 3500, 9999, 2, 1, 1),
(3, 35000, 1500, 35000, 3, 1, 1),
(4, 3000, 900, 900, 4, 2, 1),
(5, 5000, 900, 5000, 4, 3, 1),
(6, 5000, 900, 5000, 4, 4, 1),
(7, 2000, 1200, 2000, 4, 5, 1),
(8, 1000, 1000, 1000, 5, 5, 1),
(9, 50000, 4500, 50000, 4, 6, 1),
(10, 20000, 2000, 20000, 1, 7, 1),
(11, 10000, 3000, 10000, 2, 7, 1),
(12, 45000, 1500, 45000, 4, 7, 1),
(13, 10000, 2000, 10000, 1, 8, 1),
(14, 5000, 3000, 5000, 2, 8, 1),
(15, 35000, 1500, 35000, 4, 8, 1),
(16, 10000, 1000, 10000, 1, 9, 1),
(17, 5000, 1500, 5000, 2, 9, 1),
(18, 20000, 700, 20000, 4, 9, 1),
(19, 12000, 1000, 12000, 4, 10, 1),
(20, 12000, 1000, 12000, 4, 11, 1),
(21, 50000, 4500, 50000, 4, 12, 1);


INSERT INTO `purchases` (`id_purchase`, `date_purchase`, `id_user`) VALUES
(1, '2018-11-26 22:40:17', 1);


INSERT INTO `purchase_items` (`id_purchase_item`, `quantity`, `price`, `id_purchase`, `id_seat`) VALUES
(1, 1, 3500, 1, 2);

INSERT INTO `tickets` (`id_ticket`, `number_ticket`, `qr`, `id_purchase_item`) VALUES
(1, 1, 0x18ebf8d80fef99ba6977adbb1f4f3c13975e8a9564de42f4cd2ac102c0a621b73b783f2e5140e831cee5a3447356fede6bef3c55b65a25d99ed974cbbf29920e42ac4bd5910b504af1799ed2c055b956a25775c97e23aae5d870de51696e4a26e86b5d886afdaa929c8e7c57f381ea826ece0093265611cf476c18fee60747bbf0a541a6be1a26fb6529ff57a94e08cc95af4774eebc01836c711635c68050a7ed05e6bf191a9eaa0900159529ddd0b0c39f905e03d12d14e983918b8d80ef6d4073b6d29365966f41ce12ec3e3b2be197768763e64eeabd73ade6cc265717ff77fbdd26c233ecf2ddd7bd8a19017ff7feee53376f1cb62f153d0f6d49f4a9, 1);

