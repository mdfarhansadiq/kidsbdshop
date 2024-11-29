<?php 
if( isset($_POST['FR_SelectDistrick']) ){
   $FR_sDis = $_POST['FR_SelectDistrick'];
    
//FRD_VC____1:-
if(!isset($FR_sDis)){ header("LOCATION:https://google.com"); exit; }
    
// Barisal
$FR_Barguna = array( "Amtali","Bamna","Barguna Sadar","Betagi","Patharghata" );
$FR_Barishal = array( "Agailzhara","Babuganj","Barajalia","Barishal Sadar","Gouranadi","Mahendiganj","Muladi","Sahebganj","Uzirpur" );
$FR_Bhola = array( "Bhola Sadar","Borhanuddin UPO","Charfashion","Doulatkhan","Hajirhat","Hatshoshiganj","Lalmohan UPO" );
$FR_Jhalokathi = array( "Jhalokathi Sadar","Kathalia","Nalchhiti","Rajapur" );
$FR_Patuakhali = array( "Bauphal","Dashmina","Galachipa","Khepupara","Patuakhali Sadar","Subidkhali" );
$FR_Pirojpur = array( "Banaripara","Bhandaria","Indurkani","kaukhali","Mathbaria","Nazirpur","Pirojpur Sadar","Swarupkathi" );

// Chittagong
$FR_Bandarban = array( "Alikadam","Bandarban Sadar","Naikhong","Roanchhari","Ruma","Thanchi" );
$FR_Brahmanbaria = array( "Akhaura","Ashuganj","Banchharampur","Brahamanbaria Sadar","Kasba","Nabinagar","Nasirnagar","Sarail" );
$FR_Chandpur = array( "Chandpur Sadar","Faridganj","Hajiganj","Hayemchar","Kachua","Matlobganj","Shahrasti" );
$FR_Chittagong = array( "Anawara","Boalkhali","Chittagong Sadar","East Joara","Fatikchhari","Hathazari","Jaldi","Lohagara","Mirsharai","Patiya","Rangunia","Rouzan","Sandwip","Satkania","Sitakunda" );
$FR_Comilla = array( "Barura","Brahmanpara","Burichang","Chandina","Chouddagram","Comilla Sadar","Daudkandi","Davidhar","Homna","Kotwali Model","Laksam","Langalkot","Lalmai","Muradnagar","Monohorgonj","Meghna","Titas" );
$FR_Coxs_Bazar = array( "Chiringga","Cox's Bazar Sadar","Gorakghat","Kutubdia","Ramu","Teknaf","Ukhia" );
$FR_Feni = array( "Chhagalnaia","Dagonbhuia","Feni Sadar","Pashurampur","Sonagazi" );
$FR_Khagrachari = array( "Diginala","Khagrachari Sadar","Laxmichhari","Mahalchhari","Manikchhari","Matiranga","Panchhari","Ramghar Head Office" );
$FR_Lakshmipur = array( "Char Alexgander","Lakshimpur Sadar","Ramganj","Raypur" );
$FR_Noakhali = array( "Basurhat","Begumganj","Chatkhil","Hatiya","Noakhali Sadar","Senbag" );
$FR_Rangamati = array( "Barakal","Bilaichhari","Jarachhari","Kalampati","kaptai","Longachh","Marishya","Naniachhar","Rajsthali","Rangamati Sadar" );


// Dhaka
$FR_Dhaka = array( "Adabor","Bashudhara R/A","Bangshal","Badda","Bimanbandar","Demra","Dhaka Cantt.","Chawkbazar Model","Dhamrai","Dhanmondi","Dakshinkhan","Darus Salam","Gulshan","Gendaria","Hazaribagh","Jatrabari","Joypara","Keraniganj","Kadamtali","Khilgaon","Kalabagan","Kafrul","Kamrangirchar","Kotwali","Khilkhet","Lalbag","Mirpur","Mirpur Model","Mohammadpur","Motijheel","Nawabganj","New market","Palton","Pallabi","Ramna","Rampura","Sabujbag","Shah Ali","Sher-e-Bangla Nagar","Shyampur","Savar","Sutrapur","Shahbag","Tejgaon","Turag","Tejgaon I/A","Uttara","Uttar Khan","vatara" );
$FR_Faridpur = array( "Alfadanga","Bhanga","Boalmari","Charbhadrasan","Faridpur Sadar","Madukhali","Nagarkanda","Sadarpur","Shriangan" );
$FR_Gazipur = array( "Bason","Gazipur Sadar","Kaliakaar","Kaliganj","Kapashia","Monnunagar","Sreepur","Sripur" );
$FR_Gopalganj = array( "Gopalganj Sadar","Kashiani","Kotalipara","Maksudpur","Tungipara" );
$FR_Kishoreganj = array( "Bajitpur","Bhairob","Hossenpur","Itna","Karimganj","Katiadi","Kishoreganj Sadar","Kuliarchar","Mithamoin","Nikli","Ostagram","Pakundia","Tarial" );
$FR_Madaripur = array( "Barhamganj","kalkini","Madaripur Sadar","Rajoir" );
$FR_Manikganj = array( "Doulatpur","Gheor","Lechhraganj","Manikganj Sadar","Saturia","Shibloya","Singari" );
$FR_Munshiganj = array( "Gajaria","Lohajong","Munshiganj Sadar","Sirajdikhan","Srinagar","Tangibari" );
$FR_Narayanganj = array( "Araihazar","Baidder Bazar","Bandar","Fatullah","Narayanganj Sadar","Rupganj","Siddirganj" );
$FR_Narshingdi = array( "Belabo","Monohordi","Narshingdi Sadar","Palash","Raypura","Shibpur" );
$FR_Rajbari = array( "Baliakandi","Pangsha","Rajbari Sadar" );
$FR_Shariatpur = array( "Bhedorganj","Damudhya","Gosairhat","Jajira","Naria","Shariatpur Sadar" );
$FR_Tangail = array( "Basail","Bhuapur","Delduar","Ghatail","Gopalpur","Kalihati","Kashkaolia","Madhupur","Mirzapur","Nagarpur","Sakhipur","Tangail Sadar" );


// Khulna
$FR_Bagherhat = array( "Bagherhat Sadar","Chalna Ankorage","Chitalmari","Fakirhat","Kachua UPO","Mollahat","Morelganj","Rampal","Rayenda" );
$FR_Chuadanga = array( "Alamdanga","Chuadanga Sadar","Damurhuda","Doulatganj" );
$FR_Jessore = array( "Bagharpara","Chaugachha","Jessore Sadar","Jhikargachha","Keshabpur","Monirampur","Noapara","Sarsa" );
$FR_Jinaidaha = array( "Harinakundu","Jinaidaha Sadar","Kotchandpur","Maheshpur","Naldanga","Shailakupa" );
$FR_Khulna = array( "Alaipur","Batiaghat","Bheramara","Chalna Bazar","Digalia","Dumuria","Janipur","Khulna Sadar","Kumarkhali","Madinabad","Paikgachha","Phultala","Sajiara","Terakhada","Rafayetpur","Rupsha");
$FR_Kushtia= array( "BHERAMARA","DAULATPUR","KHOKSA","KUMARKHALI","KUSHTIA SADAR","MIRPUR" );
$FR_Magura = array( "Arpara","Magura Sadar","Mohammadpur","Shripur" );
$FR_Meherpur = array( "Gangni","Meherpur Sadar" );
$FR_Narail = array( "Kalia","Laxmipasha","Mohajan","Narail Sadar" );
$FR_Satkhira = array( "Ashashuni","Debbhata","kalaroa","Kaliganj UPO","Nakipur","Satkhira Sadar","Shaymnagar","Taala" );

// Mymensingh
$FR_Mymensingh = array( "Bhaluka","Trishal","Haluaghat","Muktagacha","Dhobaura","Fulbaria","Gaffargaon","Gauripur","Ishwarganj","Mymensingh Sadar","Nandail","Phulpur","Tara Khanda" );
$FR_Netrokona = array( "Atpara","Barhatta","Durgapur","Khaliajuri","Kalmakanda","Kendua","Madan","Mohanganj","Netrokona Sadar","Purbadhala" );
$FR_Jamalpur = array( "Dewanganj","Baksiganj","Islampur","Jamalpur Sadar","Madarganj","Melandaha","Sarishabari" );
$FR_Sherpur = array( "Sherpur Sadar","Nalitabari","Sreebardi","Jhenaigati","Nakla" );


// Rajshahi
$FR_Bogra = array( "Alamdighi","Bogra Sadar","Dhunat","Dupchachia","Gabtoli","Kahalu","Nandigram","Sariakandi","Sherpur","Shibganj","Sonatola" );
$FR_Chapinawabganj = array( "Bholahat","Chapinawabganj Sadar","Nachol","Rohanpur","Shibganj U.P.O" );
$FR_Joypurhat = array( "Akkelpur","Joypurhat Sadar","kalai","Khetlal","panchbibi" );
$FR_Naogaon = array( "Ahsanganj","Badalgachhi","Dhamuirhat","Mahadebpur","Naogaon Sadar","Niamatpur","Nitpur","Patnitala","Prasadpur","Raninagar","Sapahar" );
$FR_Natore = array( "Gopalpur UPO","Harua","Hatgurudaspur","Laxman","Natore Sadar","Singra" );
$FR_Pabna = array( "Banwarinagar","Bera","Bhangura","Chatmohar","Debottar","Ishwardi","Pabna Sadar","Sathia","Sujanagar" );
$FR_Rajshahi = array( "Bagha","Bhabaniganj","Charghat","Durgapur","Godagari","Khod Mohanpur","Lalitganj","Putia","Rajshahi Sadar","Tanor" );
$FR_Sirajganj = array( "Baiddya Jam Toil","Belkuchi","Chouhali","Dhangora","Kazipur","Shahjadpur","Sirajganj Sadar","Tarash","Ullapara" );

// Rangpur
$FR_Dinajpur = array( "Bangla Hili","Biral","Birampur","Birganj","Chrirbandar","Dinajpur Sadar","Khansama","Maharajganj","Nababganj","Osmanpur","Parbatipur","Phulbari","Setabganj" );
$FR_Gaibandha = array( "Bonarpara","Gaibandha Sadar","Gobindaganj","Palashbari","Phulchhari","Saadullapur","Sundarganj" );
$FR_Kurigram = array( "Bhurungamari","Chilmari","Kurigram Sadar","Nageshwar","Rajarhat","Rajibpur","Roumari","Ulipur" );
$FR_Lalmonirhat = array( "Aditmari","Hatibandha","Lalmonirhat Sadar","Patgram","Tushbhandar" );
$FR_Nilphamari = array( "Dimla","Domar","Jaldhaka","Kishoriganj","Nilphamari Sadar","Syedpur" );
$FR_Panchagarh = array( "Boda","Chotto Dab","Dabiganj","Panchagarh Sadar","Tetulia " );
$FR_Rangpur = array( "Badarganj","Gangachara","Kaunia","Mithapukur","Pirgachha","Rangpur Sadar","Taraganj" );
$FR_Thakurgaon = array( "Baliadangi","Haripur","Pirganj","Rani Sankail","Thakurgaon Sadar" );

// Sylhet
$FR_Hobiganj = array( "Azmireeganj","Bahubal","Baniachang","Chunarughat","Hobiganj Sadar","Kalauk","Lakhai","Madhabpur","Nabiganj" );
$FR_Moulvibazar	= array( "Baralekha","Kamalganj","Kulaura","Moulvibazar Sadar","Rajnagar","Srimangal" );
$FR_Sunamganj = array( "Bishamsarpur","Chhatak","Dhirai Chandpur","Duara Bazar","Ghungiar","Jagnnathpur","Sachna","Sunamganj Sadar","Tahirpur" );
$FR_Sylhet = array( "Balaganj","Bianibazar","Bishwanath","Fenchuganj","Goainhat","Gopalganj","Jaintapur","Jakiganj","Kanaighat","Kompanyganj","Sylhet Sadar","South Surma" ); 
    
    
    
    
$FR_THANA_V =  "FR_$FR_sDis";             
$FR_ThanaArr = $$FR_THANA_V;
              
    $FR_OUTPUT_HTML = "";
    $FR_OUTPUT_HTML .= "<option value=''>Select Thana </option>";
    foreach ($FR_ThanaArr as $FR_item) {
         $FR_OUTPUT_HTML .= "<option value='$FR_item'>$FR_item</option>";
    } 
    echo "$FR_OUTPUT_HTML";
    
}
?>