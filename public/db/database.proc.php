<?php
$db = new SQLite3('musics.db');

$db->exec("CREATE TABLE IF NOT EXISTS 'musics' (
	'mus_id' INTEGER,
	'mus_nom' TEXT,
	'mus_naixement' TEXT,
	'mus_estil' TEXT,
	'mus_imatge' TEXT,
	PRIMARY KEY('mus_id' AUTOINCREMENT)
);");

$db->exec("INSERT INTO 'musics' ('mus_nom', 'mus_naixement', 'mus_estil', 'mus_imatge') VALUES 
('Ludwig van Beethoven', '1770-12-17', 'Clàssic', 'https://upload.wikimedia.org/wikipedia/commons/6/6f/Beethoven.jpg'),
('Freddie Mercury', '1946-09-05', 'Rock', 'https://hips.hearstapps.com/hmg-prod/images/freddie-mercury-queen-chaqueta-amarilla-9-agosto-1986-1502982487.jpg'),
('Michael Jackson', '1958-08-29', 'Pop', 'https://media.vogue.es/photos/6538fee5e68177b3d0971e69/1:1/w_640,h_640,c_limit/Michael%20Jackson.jpeg'),
('Amador Rivas', '1976-12-01', 'Pop', 'https://estaticos-cdn.prensaiberica.es/clip/4a0e8bed-44a7-4de8-a6cb-0ffbfcd0255d_alta-libre-aspect-ratio_default_0.jpg')
;");

$db->close();
?>
