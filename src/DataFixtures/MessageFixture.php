<?php

namespace App\DataFixtures;

use App\Entity\Message;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MessageFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $message1 = new Message();
        $message1->setRecipient('Anna');
        $message1->setSender('Julia');
        $message1->setSubject('Ważne ogłoszenie dotyczące spotkania');
        $message1->setContent('You can easily check which shell youre currently using on your macOS system by using the following command in the Terminal: sh: echo $SHELL');
        $message1->setStatus(1);
        $manager->persist($message1);

        $message2 = new Message();
        $message2->setRecipient('Marek');
        $message2->setSender('Stefek');
        $message2->setSubject('Przypomnienie o terminie złożenia raportu');
        $message2->setContent('Opierając się na standardzie PRINCE2 można przyjąć, że biuro wsparcia projektów jest centralną pulą wyspecjalizowanych zasobów pełniących rolę wsparcia projektu w postaci m.in. pomocy administracyjnej, zarządzania konfiguracją oraz w miarę możliwości konsultacji w zakresie stosowania metodyki PRINCE2.');
        $message2->setStatus(1);
        $manager->persist($message2);

        $message3 = new Message();
        $message3->setRecipient('Katarzyna');
        $message3->setSender('Janusz');
        $message3->setSubject('Podsumowanie roku i plany na przyszłość');
        $message3->setContent('Woda - to tu liczy się uwaga, ostrożność oraz przezorność. Przecenienie własnych możliwości podczas kąpieli i brak należytej opieki nad dziećmi mogą okazać się fatalne w skutkach. By wypoczynek nie zmienił się w tragedię, wystarczy przestrzegać kilku prostych zasad. Pamiętajmy, bezpieczny wypoczynek zależy głównie tylko od nas samych!');
        $message3->setStatus(1);
        $manager->persist($message3);

        $message4 = new Message();
        $message4->setRecipient('Piotr');
        $message4->setSender('Zbychu');
        $message4->setSubject('Aktualizacja polityki bezpieczeństwa danych');
        $message4->setContent('Dzień dobry! Przypominamy o nadchodzącym spotkaniu zespołu jutro o 14:00. Prosimy o przygotowanie raportów i kwestii do omówienia. Do zobaczenia!');
        $message4->setStatus(1);
        $manager->persist($message4);

        $message5 = new Message();
        $message5->setRecipient('Magdalena');
        $message5->setSender('Totek');
        $message5->setSubject('Dziękujemy za udział w wydarzeniu');
        $message5->setContent('Witaj! Cieszę się, że możemy ogłosić nowy projekt. Praca nad nim już się rozpoczęła. Prosimy o przekazanie swoich pomysłów i sugestii. Razem osiągniemy sukces!');
        $message5->setStatus(1);
        $manager->persist($message5);

        $message6 = new Message();
        $message6->setRecipient('Jakub');
        $message6->setSender('Majkel');
        $message6->setSubject('Weryfikacja danych dostępu do konta');
        $message6->setContent('Witam serdecznie! W związku z aktualizacją systemu prosimy o zmianę hasła dostępu do konta w ciągu najbliższych 7 dni. Dziękujemy za współpracę.');
        $message6->setStatus(1);
        $manager->persist($message6);

        $message7 = new Message();
        $message7->setRecipient('Natalia');
        $message7->setSender('Włodzio');
        $message7->setSubject('Wyniki ankiety satysfakcji klientów');
        $message7->setContent('Dzień dobry! Pragniemy poinformować, że nasza firma zostanie zamknięta na przerwę świąteczną od 24 grudnia do 2 stycznia. Życzymy radosnych Świąt i szczęśliwego Nowego Roku!');
        $message7->setStatus(1);
        $manager->persist($message7);

        $message8 = new Message();
        $message8->setRecipient('Tomasz');
        $message8->setSender('Łysy');
        $message8->setSubject('Zmiana godzin otwarcia w okresie wakacyjnym');
        $message8->setContent('Cześć! W ramach dzisiejszego szkolenia omówimy nowe procedury bezpieczeństwa. Przypominamy o obowiązku udziału. Spotkanie odbędzie się o 10:00 w sali konferencyjnej.');
        $message8->setStatus(1);
        $manager->persist($message8);

        $message9 = new Message();
        $message9->setRecipient('Karolina');
        $message9->setSender('Boss');
        $message9->setSubject('Wszyscy jesteście zwolnieni!');
        $message9->setContent('Hej! W związku z nadchodzącym wydarzeniem firmowym potrzebujemy zgłoszeń chętnych do organizacji. Jeśli masz pomysły lub chciałbyś pomóc, daj nam znać!');
        $message9->setStatus(1);
        $manager->persist($message9);

        $message10 = new Message();
        $message10->setRecipient('Łukasz');
        $message10->setSender('Patryk');
        $message10->setSubject('Uścisk doni');
        $message10->setContent('Dzień dobry! Chcielibyśmy podziękować za twój wkład w ostatni projekt. Twoje zaangażowanie i profesjonalizm naprawdę się liczą. Jesteśmy dumni z efektów!');
        $message10->setStatus(1);
        $manager->persist($message10);

        $message11 = new Message();
        $message11->setRecipient('Bart');
        $message11->setSender('Iva');
        $message11->setSubject('Wakacyjne lenistwo');
        $message11->setContent('Witaj w naszym nowym sklepie internetowym! Teraz możesz cieszyć się zakupami z wygodą w domu. Zapraszamy do zapoznania się z naszą nową ofertą.');
        $message11->setStatus(1);
        $manager->persist($message11);

        $manager->flush();
    }
}
