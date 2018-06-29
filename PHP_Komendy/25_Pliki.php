<?php
/*
#Konfiguracja:

W przypadku access denied  konsoli linux wpisać:
sudo chmod -R 777 [folder_workspace] , gdzie R oznacza rekirsive - folder i podkatalogi

Aby sprawdzić ściężkę do katalogu daj:
$_SERVER['DOCUMENT_ROOT'] + nazwa naszego katalogu
sudo chmod -R 777 ~/Workspace/fakturaweb/user/uploads/
sudo chmod -R 777 /var/www/html/suplementytrisana/

--------------------


#Otwieranie pliku:
fopen – otwiera dany plik z możliwością wyboru trybu. Zwraca wskaźnik do pliku, który będziemy wykorzystywać przy operacjach na tym pliku.

Lista możliwych trybów:
r – tylko odczyt,
w – tylko zapis, zaczyna zapisywać od początku pliku i czyści jego zawartość (nadpisuje). Jeżeli plik nie istnieje, to go tworzy.
a – tylko zapis, zaczyna zapisywać na końcu pliku (dodaje),
r+ , w+ – to samo co r+w,
a+ – to samo co r+a.

Przykład:
$handle = fopen("/home/resource.txt", "r")

-------------------

#Odczyt:
-fread – odczytuje zadaną liczbę bajtów z pliku,
-fgets – odczytuje jedną linię z pliku,
-fgetc – odczytuje jeden znak z pliku,
-fpassthru – odczytuje plik do końca i zawartość wysyła do bufora wyjściowego.

Przykład:
$contents = fread($handle, filesize($filename));
$buffer = fgets($handle);

--------------------

#Zapis:
-fputs , fwrite – zapisuje dany string do pliku, zwraca liczbę bajtów.

Przykład:
$length = fwrite($handle, $text);

$file = fopen("example.txt", "w");
echo(fwrite($file, "Hello World. Testing!"));
fclose($file);

---------------------

#Wykrywanie końca pliku:
-feof – funkcja zwraca true, jeżeli osiągnięty został koniec pliku (End Of File).

Przykład:
$handle = fopen('somefile.txt', 'r');
if(feof($handle)) {
echo("koniec pliku");
}

---------------------

#Zamykanie pliku:
Każdy wskaźnik do pliku powinien być zamknięty funkcją fclose, jeżeli skończyliśmy wykonywać operację na pliku.

Przykład:
$handle = fopen('somefile.txt', 'r');
fclose($handle);

---------------------

#Na skróty:

Funkcja file odczytuje cały plik o podanej nazwie i zwraca jego zawartość w postaci tablicy. Jeden wiersz tablicy odpowiada jednej linii tekstu.

Przykład:
$array = file('somefile.txt');

--

file_get_contents – odczytuje cały plik o podanej nazwie i zwraca jego zawartość. Pozwala w prosty sposób wczytać zawartość pliku.

Przykład:
$file = file_get_contents('people.txt');

--

file_put_contents – analogicznie funkcja pozwala w prosty sposób zapisać do pliku dany tekst. Domyślnie funkcja nadpisuje plik!

Przykład:
file_put_contents($file, $txt);
file_put_contents($file, $txt, FILE_APPEND | LOCK_EX);


-------------------------

#Nie tylko pliki:
Niektóre funkcje obsługujące pliki można zastosować również do adresów URL. Są to m.in.:
-fopen,
-file_get_contents,
-file,
-file_exists,
-filesize.

Dzięki temu w prosty sposób możemy również pobrać dane przez protokół HTTP lub FTP.
Należy pamiętać że do działania z adresami URL konieczna może być zmiana konfiguracji PHP na serwerze.

Przykłady:
$homepage = file_get_contents('http://www.ex.mo/');
$handle = fopen("http://www.ex.mo/", "r");
$handle = fopen("ftp://user:password@ex.mm/somefile.txt", "w");

-------------------------


#Operacje na plikach:
rename – zmienia nazwę pliku
unlink – usuwa plik
filesize – zwraca wielkość pliku w bajtach
filetype – zwraca typ zasobu (file, dir, link, char itp.)
fstat – zwraca tabelę z informacjami o pliku (m.in. wielkość, czas utworzenia, modyfikacji, dostępu)

--------------------------


#Operacje na katalogach:
mkdir – tworzy katalog
rmdir – usuwa katalog

is_*:
is_dir - sprawdza, czy argument jest katalogiem
is_file - sprawdza, czy argument jest plikiem
is_link – sprawdza, czy argument jest linkiem
is_readable – sprawdza, czy można odczytać plik
is_writable – sprawdza, czy można zapisywać do pliku.

--------------------------

#Upload pliku:
Protokół HTTP umożliwia przesyłanie plików tylko w zapytaniu typu POST.
Jest to bardzo wygodna dla użytkowników forma przesyłania plików do naszej strony.
Stosuje się ją z reguły dla małych i średnich plików ze względu na ograniczenia transferu.

--------------------------

#Formularz:
Aby na stronie umożliwić wybranie i przesłanie pliku stosujemy tag <input> typu file. W formularzu wybieramy metodę POST i dodajemy
rodzaj kodowania enctype="multipart/form-data"

<form action="upload.php" method="post"
 <input type="file" name="fileToUpload" id="fileToUpload">
 <input type="submit" value="Upload Img" name="submit">
</form>


--------------------------

#Zmienna $_FILES:
Po stronie serwera informacje o przesłanych w żądaniu plikach znajdziemy w zmiennej superglobalnej $_FILES.
Klucz w tablicy jest identyczny jak atrybut name inputa typu file czyli w tym wypadku:

<input type="file" name=”userfile” id="fileToUpload">

$_FILES['userfile']['name'] – oryginalna nazwa pliku.
$_FILES['userfile']['type'] – typ mime pliku, np. 'image/gif'.
$_FILES['userfile']['size'] – wielkość pliku w bajtach.
$_FILES['userfile']['tmp_name'] - tymczasowa nazwa pliku na serwerze.
$_FILES['userfile']['error'] – kod błędu powiązany z plikiem.


-------------------------

#Zapisanie pliku:
Plik po odebraniu przez serwer musi zostać zapisany w docelowe miejsce.
Serwer WWW przechowuje plik w katalogu tymczasowym i jeżeli go nie przeniesiemy, zostanie skasowany po zakończeniu żądania.
W tym celu korzystamy z move_uploaded_file.


$uploaddir = '/var/www/uploads/';
$uploadfile = $uploaddir . basename($_FILES ['userfile']['name']);
if(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
echo("File is valid, and was successfully
uploaded.\n");
} else {
echo("Possible file upload attack!\n");
}



#Upload wielu plików:
W jednym żądaniu możemy przesłać wiele plików:
<input type="file" name="pictures[]" />
<input type="file" name="pictures[]" />
<input type="file" name="pictures[]" />


--------------------------

#Zmienne konfiguracyjne:
Serwer WWW ogranicza wielkość akceptowanych plików. Możemy kontrolować ten limit za pomocą zmiennych konfiguracyjnych.

file_uploads – czy można uploadować pliki,
upload_max_filesize – maksymalna akceptowana wielkość pliku,
max_file_uploads – maksymalna liczba akceptowanych plików,
post_max_size – maksymalna wielkość danych dla żądania typu POST.

 */



#PRZYKŁADY:
/**
Stwórz formularz, który umożliwi upload pliku graficznego (przykładowe pliki znajdziesz w katalogu images) i zapisze ten plik w katalogu wybranym według algorytmu:

Z nazwy pliku stwórz MD5 Hash. -> np. strona http://www.md5.cz/ pokazuje jak to wygląda
Na podstawie bieżącej daty wybierz podkatalog, jeżeli nie istnieje – stwórz go,
Na postawie dwóch pierwszych znaków wybierz podkatalog w tym podkatalogu, jeżeli nie istnieje – stwórz go,
Na postawie dwóch ostatnich znaków wybierz podkatalog w tym podkatalogu, jeżeli nie istnieje – stwórz go,
Zapisz plik w ostatnim podkatalogu.

Przykładowa struktura katalogu: 2016-01-03/ad/4a/coderslab_image.jpg
Stwórz skrypt showImage.php, który umożliwi wyświetlenie tego pliku, ale nie za pomocą HTML i tagu IMG. Poszukaj podpowiedzi w Google.
 */


#W HTML - Formularz:
/*
<div>Załącz plik graficzny</div>
<form action="zad1.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
    <input type="submit" name="uploadFile" value="Wyślij plik" name="submit">
</form>
 */

$uploadImagesDir = "/home/wojciech/Workspace/WRO_PHP_W_01_Zaawansowane_PHP/1_Zadania/Dzien_2/4_Pliki_w_PHP/upload/images/";

function createFolderIfNotExists ($folderPath){
    if (is_dir($folderPath) == false)
    {
        mkdir ($folderPath, 0777, true); //0777 - pełne prawa do zapisy, true - oznacza, że również z podkatalogami
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    var_dump ($_FILES);//pokazuje informacje o wysłanym pliku w tablicy - nazwa, plik tymczasowy, rozmiar, typ

    echo "Nazwa pliku: " . $_FILES['fileToUpload']['name'] . "<br>";
    $hash = md5($_FILES['fileToUpload']['name']);

    //pierwszy sposób
//    $subFolder1 = substr($hash, 0,2);
//    $subFolder2 = substr($hash, -2,2);//ostatnie 2 znaki
//    $folderPath = $uploadImagesDir . date ("Y-m-d");
//
//    createFolderIfNotExists($folderPath);
//    createFolderIfNotExists($folderPath . '/' . $subFolder1);
//    createFolderIfNotExists($folderPath . '/' . $subFolder1 . '/' . $subFolder2);

    //można też szybciej - 2 sposób:
    $folderPathWithSubFolders = $uploadImagesDir . date ("Y-m-d") . $subFolder1 . "/" . $subFolder2;
    createFolderIfNotExists($folderPathWithSubFolders);

//Stwórz skrypt showImage.php, który umożliwi wyświetlenie tego pliku, ale nie za pomocą HTML i tagu IMG. Poszukaj podpowiedzi w Google.
    /*
   W osobnym pliku dajemy:
    header ('Content-type:image/jpg');
    readfile('D:/coders_lab_notebook.jpg'); //przykładowa ścieżka do pliku
     */

    //echo $currentDate;
//    if (is_dir($folderPath)) {
//        //echo "jest katalog";
//
//    } else {
//        echo "nie ma katalogu $folderPath";
//        mkdir ($folderPath);
//
//    }

}

/**
Skrypt wgrywający pliki na serwer
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //echo "władowano plik";
    $error = 2;

    //FILE UPLOAD VERIFICATION
    if (is_uploaded_file($_FILES['uploadedfile']['tmp_name'])) {

        switch ($_FILES['uploadedfile']['tmp_name']) {
            case 0:
                $file_error_color = "#888;";
                $file_error = 0;
                break;
            case 1:
                $error = 1;
                $file_error_color = "#e73d4a;";
                $file_error = 1;
                $file_error_message = "Błąd! Zbyt duży plik. Maksymalna wielkość pliku 1 MB.";
                break;
            case 2:
                $error = 1;
                $file_error_color = "#e73d4a;";
                $file_error = 1;
                $file_error_message = "Błąd! Zbyt duży plik. Maksymalna wielkość pliku 1 MB.";
                break;
            case 3:
                $error = 1;
                $file_error_color = "#e73d4a;";
                $file_error = 1;
                $file_error_message = "Błąd! Plik został wgrany tylko częściowo. Dodaj go jeszcze raz.";
                break;
            case 4:
                $error = 1;
                $file_error_color = "#e73d4a;";
                $file_error = 1;
                $file_error_message = "Błąd! Nie wgrano pliku.";
                break;
            case 7:
                $error = 1;
                $file_error_color = "#e73d4a;";
                $file_error = 1;
                $file_error_message = "Błąd! Nie można było zapisać pliku na dysku. Spróbuj dodać go jeszcze raz.";
            default:
                $error = 1;
                $file_error_color = "#e73d4a;";
                $file_error = 1;
                $file_error_message = "Błąd zapisu pliku.";

        }


        $max_file_size = 1024 * 1024 * 1;
        if (isset($_POST['documentsort']) && $_POST['documentsort'] == "UMOWA") {
            $max_file_size = 1024 * 1024 * 10;
        }
        if ($_FILES['uploadedfile']['size'] > $max_file_size) {
            $error = 1;
            $file_error_color = "#e73d4a;";
            $file_error = 1;
            $file_error_message = "Błąd! Zbyt duży plik. Maksymalna wielkość pliku 10 MB dla umów i 1 MB dla pozostałych dokumentów.";
        }

        $filetype = $_FILES['uploadedfile']['type'];
        if ((strpos($filetype, "image/") === false) && (strpos($filetype, "pdf") === false)) {
            //if ((strpos($filetype,"image/") === false)) {
            $error = 1;
            $file_error_color = "#e73d4a;";
            $file_error = 1;
            $file_error_message = "Błąd! Niewłaściwy typ pliku. Możesz dodawać tylko pliki graficzne (.jpg, .png, .gif) i pliki pdf.";
        }


    } else {
        $error = 1;
        $file_error_color = "#e73d4a;";
        $file_error = 1;
        $file_error_message = "Błąd! Nie wybrano pliku z dokumentem.";
    }
    //END FILE UPLOAD VERIFICATION

    //UPLOAD IF EVERYTHING IS OK
    //FILE UPLOAD
    $fileExtension = pathinfo($_FILES["uploadedfile"]["name"], PATHINFO_EXTENSION);
    $fileName = $_FILES['uploadedfile']['name'];
    $dotposition = strrpos ($fileName, ".");
    $fileName = substr($fileName,0,$dotposition);
    $fileNameBase = $fileName . "_" . $currentDateEU;
    $fileName = $fileNameBase . "." . $fileExtension;
    $folderid = $_SESSION['login_id_fakturaweb'];
    $targetFolderWithPath = __DIR__ . "/uploads/" . $folderid;
    if  (is_dir ($targetFolderWithPath) == false) {
        //Create folder
        $pathToDir2 = "/uploads/". $_SESSION['login_id_fakturaweb'];
        mkdir ($targetFolderWithPath);
    }

    $newFileName = $fileNameBase . "." . $fileExtension;
    $targetFileWithPath = $targetFolderWithPath . "/" . $newFileName;
    $counter = 1;

    if (is_file ($targetFileWithPath) == false) {
        echo "nie ma pliku";
        move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $targetFileWithPath);
    } else {
        echo "jest plik";
        $newFileName = $fileNameBase . "_" . $counter . "." . $fileExtension;
        $targetFileWithPath = $targetFolderWithPath . "/" . $newFileName;
        while (is_file($targetFileWithPath) == true) {
            $counter++;
            $newFileName = $fileNameBase . "_" . $counter . "." . $fileExtension;
            $targetFileWithPath = $targetFolderWithPath . "/" . $newFileName;
        }
        move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $targetFileWithPath);
    }
}

/**
Zabezpieczenie katalogu z plikami - tak aby nie można było ich pobrać ani podglądnąć co tam jest:

Plik .htaccess dajemy w katalogu, w którym są pliki (będzie działał również we wszystkich podkatalogach tego katalogu), a w nim wstawiamy:
Order allow,deny
Deny from all

*/

//Żeby pobrać plik należy:

session_start();
if (isset($_SESSION['authorizationfakturaweb']) && ($_SESSION['authorizationfakturaweb'] == "customer")) {
    $folderid = $_SESSION['login_id_fakturaweb'];
    $targetFolderWithPath = __DIR__ . "/uploads/" . $folderid;
    $targetFileWithPath = $targetFolderWithPath . "/" . "logo_2018-06-29.png";
    $targetFileWithPath = $targetFolderWithPath . "/" . "Faktura_HOME-2018-0003536_2018-06-29.pdf";

    //pobranie pliku
    $file = $targetFileWithPath;
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header("Content-Disposition: attachment; filename=" . basename($file) . ";");
    header("Accept-Ranges: bytes");
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: " . filesize($file));
    readfile($file);
    exit();
}

//Żeby wyświetlić np. plik pdf na ekranie monitora:

session_start();
if (isset($_SESSION['authorizationfakturaweb']) && ($_SESSION['authorizationfakturaweb'] == "customer")) {
    $folderid = $_SESSION['login_id_fakturaweb'];
    $targetFolderWithPath = __DIR__ . "/uploads/" . $folderid;
    $targetFileWithPath = $targetFolderWithPath . "/" . "logo_2018-06-29.png";
    $targetFileWithPath = $targetFolderWithPath . "/" . "Faktura_HOME-2018-0003536_2018-06-29.pdf";

    $file = $targetFileWithPath;
    $filename = 'Faktura_HOME-2018-0003536_2018-06-29.pdf';
    header('Content-type: application/pdf');
    header('Content-Disposition: inline; filename="' . $filename . '"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
    @readfile($file);
}

