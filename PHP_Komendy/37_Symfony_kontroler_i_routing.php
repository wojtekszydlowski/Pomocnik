<?php
/*
Tworzenie nowego kontrolera o nazwie first - musimy być w projekcie (katalog) i w konsoli wpisać:
php	app/console	generate:controller
i podajemy w poszczególnych krokach:
name: AppBundle:first
Routing format: annotation
Template format: twig
New action name: dajemy enter

Później w tak utworzonym kontrolerze (plik firstController.php) należałoby wstawić:

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use	Symfony\Component\HttpFoundation\Response;
*/

class firstController extends Controller
{
    /**
     * @Route("/helloWorld/")
     */
public function	helloWorldAction()
{
    return new Response('<html><body>Hello my World!</body></html>');
}
}



namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use	Symfony\Component\HttpFoundation\Response;

class firstController extends Controller
{
    /**
     * @Route("/helloWorld/")
     */
    public function	helloWorldAction()
    {
        return new Response('<html><body>Hello my World!</body></html>');
    }

    /**
     * @Route("/goodbye/{userName}/")
     */
    public function goodbyeAction($userName)
    {
        return new Response ("<html><body>Goodbye $userName</body></html>");
    }
}

/*
 Wtedy jak wpiszemy w przeglądarce: http://localhost:8080/helloWorld/ to wypisze nam: Hello my World!

[Uwagi:]
-w @Route kończyć adres ukośnikiem "/" - wtedy Symfony poprawnie zinterpretuje adres zarówno z jak i bez "/" wpisany w przeglądarce np. @Route("/helloWorld/")
*/
//----

#Przekazywanie parametrów (slugów):

/**
 *	@Route("/helloWorld/{sentence}")
 */
public function helloWorldAction($sentence)
{
    return	new	Response(
        "<html><body>Hello World!"	+
        "Your sentence is: $sentence</body></html>"
    );
}

//albo jeszcze inny przykład:

/**
 *	@Route("/hello/{userName}/{userSurname}")
 */
public function	helloAction($userName, $userSurname){
    return new	Response(
        "<html><body>Welcome $userName $userSurname</body></html>"
    );
}

//w @Route("/hello/{userName}/{userSurname}") kolejne slugi są rozdzielane ukośnikami "/".


//Wartości	domyśle	slugów:

@Route("/helloWorld/{sentence}", defaults={"sentence"="Default sentence"})

@Route("/post/{id}", defaults={"id"=1})

@Route("/post/{categoryId}/{postId}", defaults={"postId"=1,	"categoryId"=10})



//Wymagania	dotyczące slugów:

@Route("/hello/{userName}", requirements={"userName"="[a-zA-Z]+"}) //ma być napisem

@Route("/post/{id}", requirements={"id"="\d+"}) //ma być liczbą

/*
\d+ -> wartość numeryczna
[a-zA-Z]+  -> wartość alfabetyczna (tylko litery)
(fr|en|pl)  -> wartość fr, en lub pl

----
----
----

ZADANIA:

[Uwaga]
Wszystkie zadania powinny być wstawione do stworzonego pliku kontrolera - np. jeśli stworzyliśmy controller o nazwie first to plik o nazwie będzie w katalogu: src->nazwa_budnle->controller->firstController.php

Zad 1:
Stwórz nową akcję przypisaną do adresu /goodbye/{username}, gdzie: {username} jest slugiem.
Akcja ma wyświetlać napis: Goodbye + nazwa przekazana przez slug.
*/


//Rozwiązanie zadania 1:

namespace FinanceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use	Symfony\Component\HttpFoundation\Response;


class firstController extends Controller
{
    /**
     * @Route("/goodbye/{username}/")
     */
    public function	goodbyeAction($username)
    {
        return new Response("<html><body>Goodbye $username</body></html>");
    }

}


//---------
/*
Zad 2:
Stwórz nową akcję przypisaną do adresu /welcome/{name}/{surname}, gdzie: {name} i {surname} są slugami.
Akcja ma wyświetlać napis: Welcome + dane przekazane przez slugi.
Nadaj slugom wartości domyślne (np. Twoje imię i nazwisko).
*/

//Rozwiązanie zad 2:

namespace FinanceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use	Symfony\Component\HttpFoundation\Response;


class firstController extends Controller
{
    /**
     * @Route("/welcome/{name}/{surname}/", defaults={"name"="Wojtek", "surname" = "Kowalski"})
     */
    public function	welcomeAction($name, $surname)
    {
        return new Response("<html><body>Welcome: $name $surname</body></html>");
    }

}


//--------------

/*
Zad 3:
Stwórz nową akcję przypisaną do adresu /showPost/{id} gdzie: {id} jest slugiem.
Akcja ma wyświetlać napis: Showing post + id.
Dodaj odpowiednie adnotacje, tak aby id było liczbą.

 */

//Rozwiązanie zad 3:

namespace FinanceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use	Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/showPost/{id}/", requirements={"id"="\d+"})
 */
public function showPostAction($id)
{
    return new Response ("<html><body>Showing post: $id</body></html>");
}


//--------------

/*
Zad 4:
Stwórz dwie akcje:
Pierwsza akcja ma być przypisana do adresu /form i metody GET.
Ma ona wyświetlać formularz zawarty w pliku form.html.twig z polem tekstowym.
Druga akcja ma być przypisana do adresu /form i metody POST.
Akcja ma, póki co, wyświetlać to co zostało podane w formularzu

 */

//Rozwiązanie zadania 4:

namespace FinanceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use	Symfony\Component\HttpFoundation\Response;
use	Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

//Plik form.html.twig powinien się znaleźć w katalogu: nazwa_projektu->app->Resources->views

class firstController extends Controller
{
    /**
     * @Route("/form/")
     * @Method("GET")
     */
    public function formAction()
    {
        return $this->render ('form.html.twig');
    }

    /**
     * @Route("/form/")
     * @Method("POST")
     */
    public function formPostAction(Request $request)
    {
        $value = $request->request->get('text_field');
        return new Response ("<html><body>$value</body></html>");
    }
}


//-------------

/*
Zad: 5
Dodaj do całego kontrolera przedrostek /first.
Zobacz, jak zmieniły się adresy wszystkich do tej pory stworzonych przez Ciebie strony.
*/

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use	Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * @Route("/first")
 */
//Dajemy przed nazwą klasy
class firstController extends Controller
{
   // ...
}

//---------------