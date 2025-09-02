<?php

echo "Hello, World!"; //echo untuk menampilkan teks
echo "<br>"; //baris baru

//membuat variabel
$var1 = 'Putri'; //string
$var2 = 1; //integer
$var3 = 1.5;  //float
$var4 = false; //boolean

$phi = 3.14; //variabel phi
$r = 10; //variabel jari-jari
$luasLingkaran = $phi * $r * $r; //menghitung luas lingkaran
echo "Luas Lingkaran dengan jari-jari $r adalah $luasLingkaran"; //menampilkan hasil
echo"<br><br>";

echo '<br> Lingkaran dengan jari-jari ' . $r . ' adalah ' . $luasLingkaran; //menampilkan hasil dengan cara lain
echo"<br><br>";

//array numerik
$angka = [1, 2, 3, 4, 5, 6, 7, 8, 9]; //array
echo $angka[0]; //menampilkan elemen pertama dari array (menampilkan 1 element)
echo"<br><br>";

foreach ($angka as $a) { //looping untuk menampilkan semua elemen
    echo $a . "<br>"; //kalo gapake <br> pasti element nya bakal ke bawah semua
}
echo"<br><br>";

//array asosiatif
$mahasiswa = [
    'nama' => 'Putra',
    'nim' => '654321',
    'jurusan' => 'UI/UX Design'
];
echo $mahasiswa['nama']; //menampilkan nama dari array asosiatif
echo"<br><br>";

foreach ($mahasiswa as $key => $value) { //looping untuk menampilkan semua elemen
    echo "$key : $value <br>"; //menampilkan key dan value dari array asosiatif 
}
echo"<br><br>";

//array multidimensi atau array di dalam
$mahasiswa2 = [
    [
        'nama' => 'Putri',
        'nim' => '123456',
        'jurusan' => 'Teknik Informatika'
    ],
    [
        'nama' => 'Budi',
        'nim' => '654321',
        'jurusan' => 'Sistem Informasi'
    ]
    ,
    [
        'nama' => 'Siti',
        'nim' => '789012',
        'jurusan' => 'Teknik Komputer'
    ],
    [
        'nama' => 'Andi',
        'nim' => '345678',
        'jurusan' => 'Teknik Elektro'
    ],
    [
        'nama' => 'Dewi',
        'nim' => '901234',
        'jurusan' => 'Teknik Sipil'
    ]
];
echo $mahasiswa2[1]['jurusan']; //menampilkan nama dari array multidimensi
echo"<br><br>";

foreach ($mahasiswa2 as $mhs) { //looping untuk menampilkan semua elemen
    echo $mhs['nama'] . " <br> " . $mhs['nim'] . " <br> " . $mhs['jurusan'] . "<br><br>"; //menampilkan nama, nim, dan jurusan dari array multidimensi
}
echo"<br><br>";

//for, while, do while, foreach

//for loop
for ($i = 0; $i < 10; $i++) { //loop
    echo "Perulangan ke-$i <br>"; //menampilkan perulangan ke-i
}
echo"<br><br>";

//while loop
$i = 0; //inisialisasi variabel i
while ($i < 10) { //looping selama i kurang dari 10
    echo "Perulangan ke-$i <br>"; //menampilkan perulangan ke-i
    $i++; //increment variabel i
}
echo"<br><br>";

//do while loop
$i = 0; //inisialisasi variabel i
do {
    echo "Perulangan ke-$i <br>"; //menampilkan perulangan ke-i
    $i++; //increment variabel i 
} while ($i < 10); //looping selama i kurang dari 10
echo"<br><br>";
//foreach loop
$angka2 = [1, 2, 3, 4, 5, 6, 7, 8, 9]; //array
foreach ($angka2 as $a) { //looping untuk menampilkan semua elemen
    echo $a . "<

?>