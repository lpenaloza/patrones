<?php

/**
 * Singleton classes
 */
class BookSingleton
{
    private $author = 'Gamma, Helm, Johnson, and Vlissides';
    private $title = 'Design Patterns';
    private static $book = null;
    private static $isLoanedOut = false;

    private function __construct()
    {
    }

    public static function borrowBook()
    {
        if (false == self::$isLoanedOut) {
            if (null == self::$book) {
                self::$book = new BookSingleton();
            }
            self::$isLoanedOut = true;
            return self::$book;
        } else {
            return null;
        }
    }

    public function returnBook(BookSingleton $bookReturned)
    {
        self::$isLoanedOut = false;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthorAndTitle()
    {
        return $this->getTitle() . ' by ' . $this->getAuthor();
    }
}

class BookBorrower
{
    private $borrowedBook;
    private $haveBook = false;

    public function __construct()
    {
    }

    public function getAuthorAndTitle()
    {
        if (true == $this->haveBook) {
            return $this->borrowedBook->getAuthorAndTitle();
        } else {
            return "No tengo el libro";
        }
    }

    public function borrowBook()
    {
        $this->borrowedBook = BookSingleton::borrowBook();
        if ($this->borrowedBook == null) {
            $this->haveBook = false;
        } else {
            $this->haveBook = true;
        }
    }

    public function returnBook()
    {
        $this->borrowedBook->returnBook($this->borrowedBook);
    }
}

echo '<a href="/" class="link">Ir a inicio</a>';
echo '<h1>PATRON DE DISEÑO CREACIONAL - SINGLETON</h1>';

/**
 * Initialization
 */

writeln('------ INICIANDO PRUEBA DE PATRÓN SINGLETON ------');
writeln('');

$bookBorrower1 = new BookBorrower();
$bookBorrower2 = new BookBorrower();

$bookBorrower1->borrowBook();
writeln('BookBorrower1 Pidió prestado el libro');
writeln('BookBorrower1 Autor(a) y Titulo ');
writeln($bookBorrower1->getAuthorAndTitle());
writeln('');

$bookBorrower2->borrowBook();
writeln('BookBorrower2 Pidió prestado el libro');
writeln('BookBorrower2 Autor(a) y Titulo: ');
writeln($bookBorrower2->getAuthorAndTitle());
writeln('');

$bookBorrower1->returnBook();
writeln('BookBorrower1 Devolvió el libro');
writeln('');

$bookBorrower2->borrowBook();
writeln('BookBorrower2 Autor(a) y Titulo: ');
writeln($bookBorrower1->getAuthorAndTitle());
writeln('');

writeln('------ FINALIZANDO PRUEBA DE PATRÓN SINGLETON ------');

function writeln($line_in)
{
    echo $line_in . '<br/>';
}

echo '<br/><br/><a href="https://sourcemaking.com/design_patterns/singleton/php/1" _target="_blank">REFERENCIA</a>';