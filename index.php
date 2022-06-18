<!--pradedame mokytis oop-->
<!--aplikacijoje reikia sukurti vartotoją. Sukuriame modelį. Klasę galime prilyginti modeliui - aplikacijos veikėjui-->
<!--klasėje nusirodome savybes|ypatybes ir metodus, kurie gražina informaciją apie mūsų objektą-->
<!--KLASĖ-PAGRINDAS/ +YPATYBĖS - APRAŠO OBJ.SAVYBES/ + METODAI - VEIKSMAI SU OBJEKTO DUOMENIMIS-->
<?php
class User{        //klasė APSIRAŠOME IŠ DIDŽIOSIOS RAIDĖS! IR NURODYMAS TAIP PAT IŠ DIDŽIOSIOS RAIDĖS!
//kol kas nenaudojame private, protected, bet naudojame public (viešas įpatybes, kurias galima bus keisti už klasės ribų
    public $name;  //objekto ypatybė (savybė)
    public $email; //objekto ypatybė (savybė)
    public $role;  //objekto ypatybė (savybė)
    public function showUserData(){ //viešas (public) metodas, kuris,
        return[    //gražina array(masyvą) su norodytomis savybėmis
            $this->name,  //$this-> - nurodo viršuje esančią objekto ypatybę
            $this->email, //pvz.: bus gražinamas to sukurto konkretaus objekto emailas
            $this->role   //'REFERENCE Į KONKRETAUS OBJEKTO SAVYBĘ'
        ];
    }
    public function showName(){  //sukuriame dar vieną metodą būtinai klasėje
        return $this->name;      //kuris gražina tik vieną savybę - šiuo atveju vardą
//ATKREIPTI DĖMESĮ, KAD ATSKIRI METODAI GALI BŪTI NAUDOJAMI IR TAM, KAD NERODYTŲ VISOS INFORMACIJOS
    }
}
//SUKURIAME NAUJĄ OBJEKTĄ (su žodeliu - new) ir nurodome klasę, kurios pagrindu mes jį kuriame - User()
$userOne =  new User(); //Kuriame BE jokių konstruktorių (pradžiai). SKLIAUSTELIAI - BŪTINI!
var_dump($userOne); echo "<br>"; //object(User)#1 (3) { ["name"]=> NULL ["email"]=> NULL ["role"]=> NULL }
//array values visur NULL, nes objektui dar nepriskyrėme savybių. Pamokos tikslams jas priskirsime paprastai
$userOne->name='Jonas';         //$userOne yra objektas. Norint pridėti jam reikšmę name, kreipiamės į savybę name
$userOne->email='jonas@lrt.lt'; //ir priskiriame reikšmę $objektas -> savybė = 'rekšmė'
$userOne->role='Admin';

var_dump($userOne);  echo "<br>";   //object(User)#1 (3) { ["name"]=> string(5) "Jonas"
                                    //["email"]=> string(12) "jonas@lrt.lt" ["role"]=> string(5) "Admin" }
//bet norime gauti masyvą kurį apsirašėme prieš tai. Tai tam var_dump įrašome -> ir galime kreiptis tiek į savybę,
//tiek į metodą (atsiranda 'm' raidelė berašant phpStorm'e ties metodo pavadinimu).
var_dump($userOne->showUserData());
//GAUNAME MASYVĄ: array(3) { [0]=> string(5) "Jonas" [1]=> string(12) "jonas@lrt.lt" [2]=> string(5) "Admin" }
//Galime naudoti ir foreach, sekančiai:
foreach ($userOne->showUserData() as $data) {
    echo "$data</br>";  //išveda duomenis atskirose eilutėse: Jonas jonas@lrt.lt Admin
}
echo "Išvedame antru klasės metodu tik vartotojo vardą su - objektas->metodas() .Gauname: ".$userOne->showName();
echo "</br>"; //Išvedame antru klasės metodu tik vartotojo vardą su - objektas->metodas() .Gauname: Jonas
var_dump($userOne->showName()); echo "<br>"; //string(5) "Jonas"
//SUSIKURIAME DAR VIENĄ VARTOTOJĄ
//Jei neperrašyti userOne į userTwo tai var_dump: object(User)#2 (3) { ["name"]=> NULL ["email"]=> NULL ["role"]=> NULL }
$userTwo =  new User();  //SKLIAUSTELIAI - BŪTINI! ŠĮ KARTĄ var_dump JAU PARODO object(User)#2 ypatybes
var_dump($userTwo); echo "<br>";
$userTwo->name='Petras';         //$userOne yra objektas. Norint pridėti jam reikšmę name, kreipiamės į savybę name
$userTwo->email='petras@tv3.lt'; //ir priskiriame reikšmę $objektas -> savybė = 'rekšmė'
$userTwo->role='User';
var_dump($userTwo->showUserData());echo "<br>";echo $userTwo->showName()."<br>";var_dump($userTwo->showName());echo "<br>";
//tos pačios klasės pagrindu, kur galioja tos pačios savybės ir metodai galima sukurti neribotą skaičių objektų
//kintamojo pavadinime skaičių geriau nenaudoti.
//PAPRASČIAUSIOS KLASĖS PAVYZDYS:
class Sostines{
    public $pavadinimas;
    public function grazintiPavadinima(){
                return $this->pavadinimas;
    }
}
//Vienos klasės pagrindu galima sukurti (instance) neribotą kiekį objektų. Klasės pavyzdys. Analizuoju:
class Vartotojas                     //nustatomas klasės duomenų rinkinio tipas ir priskiriamas pavadinimas
{ //jei ypatybės yra protected -  Cannot access protected property Vartotojas::$vardas
    public $vardas;               //ypatybė - vardas
    public $vartotojai = [];      //ypatybė - vartotojų masyvas

    public function add($vardas){    //metodas - pridėti vardą į
        $this->vartotojai = $vardas; //masyvą users
    }

    public function userList(){      //metodas pavadinimu userList
        return $this->vartotojai;    //gražinantis masyvą users
    }
}

$tomas = new Vartotojas();
$tomas->add('Tomas');echo "<br>";
var_dump($tomas);
$ieva = new Vartotojas();
$ieva->add('Ieva');echo "<br>";
var_dump($ieva);
$toma = new Vartotojas();
$toma->add('Toma');echo "<br>";
var_dump($toma); echo "<br>";

$testVartotojai=new Vartotojas();$testVartotojai->vardas='Vardas'; var_dump($testVartotojai); echo "<br>";
//object(Vartotojas)#3 (2) { ["vardas"]=> string(5) "Tomas" ["vartotojai"]=> array(0) { } }

//Pseudo kintamasis $this yra prieinamas, kai metodas iškviečiamas objekto kontekste.
//$this - nuoroda į patį objektą. Pvz:
class Demo
{
    // deklaruota savybė
    public $var = 'test';

    // deklaruotas metodas
    public function displayVar() {
        echo $this->var;  // nuoroda į objekto savybę var
    }
}
//stdClass - Tuščia klasė, kuri neturi deklaruotų metodų ir savybių. Naudojama objekto kūrimui, nekuriant klasės.
$user = new stdClass();
$user->name = "Vardas";
$user->email = "vardas@gmail.com";
$user->points = 134;
$user->points++;
var_dump($user); echo "<br>";

//KURIAME KLASĘ SU CONTRUCT. TAM, KAD NERAŠYTI DAUG EILUČIŲ KODO IR BŪTŲ PATOGIAU.
//(panašumas į kintamųjų delegavimą į funkciją kitose kalbose, tik čia yra klasė. Nžn, kam taip sudėtingai)
//Python ir .Net tiesiog užtenka function pavadinimas (delagatas, delegatas, delegatas = reikšmė)
class VartotojasSuConstruct{
    public $name; //Objekto ypatybė - šiuo atveju ją galime priskirti kitaip, lengviau
    public $email;
    public $role;
//Jei konstr. yra klasėje - JO NEGALIMA APEITI, JIS VISADA BUS KVIEČIAMAS
    public function __construct($name,$email,$role){
        $this->name=$name;
        $this->email=$email;
        $this->role=$role;
    }
    public function grazintiVartotojoDuomenis()
    { //viešas (public) metodas, kuris,
        return [    //gražina array(masyvą) su norodytomis savybėmis
            $this->name,  //$this-> - nurodo viršuje esančią objekto ypatybę
            $this->email, //pvz.: bus gražinamas to sukurto konkretaus objekto emailas
            $this->role   //'REFERENCE Į KONKRETAUS OBJEKTO SAVYBĘ'
        ];
    }
}
$pirmasVartotojas = new VartotojasSuConstruct('Aloyzas', 'aloyzas@gmail.com','User');
var_dump($pirmasVartotojas->grazintiVartotojoDuomenis());  echo "<br>";
foreach($pirmasVartotojas->grazintiVartotojoDuomenis() as $data){echo "$data<br>";}
