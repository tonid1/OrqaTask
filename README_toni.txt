Korisnici s uploadanim datotekama: 

toni:password
toni12:password

Super admin:

super:password

Dodana je mogućnost registracije novih korisnika. Svaki registrirani korisnik dobije automatski rolu usera. 
Na registracijskoj i login formi su dodani prikazi errora. 
Super admin ima opciju pregleda, preuzimanja i brisanja svih uploadanih fileova kao i pregled svih korisnika i koliko su potrošili prostora.
Useri imaju pregled svojih fileova i upravljanje njima i svog profila.

Za model korisnika sam iskoristio defaultni User model uz samo dodatak role. Druga opcija bi bila dodat model OrqaUser gdje bi u principu bilo sve isto kao i defaultni.

Na stranici profila sam dodao i progress bar trenutno iskorištenog prostora u odnosu na maksimum, ali fileovi su još mali u odnosu na ograničenje kako bi se vidio napredak, može se samo kroz inspect promijeniti width da se vidi kako bi to izgledalo. Također sam i u backendu dodao provjeru ima li korisnik dovoljno prostora prije uploadanja filea na server.

Što se ikonica file-ova tiče, tu sam samo uploadao 8 različitih opcija u storage/app/public, možda postoji i neki API koji spaja ekstenzije s istim ikonicama, ali princip bi bio isti u view-u.

Na kraju dana mi je najteže bilo prebaciti se na bootstrap obzirom da sam godinama koristio samo custom made SASS, iako sam na kraju pisanja projekta već dosta lakše pronalazio potrebne klase.

Naravno, da je u pitanju gotov proizvod dodao bih još stvari, od user friendly loadera kod uploada filea do dodatne stranice gdje samo super admin može dodavati novog admina i ostale quality of life dodatke.

Uvjeren sam da bi s više korištenja agenata bilo jednostavnijih laravel metoda koje mogu zamijeniti dio koda, više sam pažnje dao prikazu pravilne arhitekture projekta i mog dosadašnjeg znanja u tom.