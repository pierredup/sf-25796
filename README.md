symfony/symfony#25796 reproducer
===========

Stepts to reproduce:

* Create clean Symfony 3.4.3 project
* Create `TestTrait` in `AppBundle\Controller`
```php
<?php
namespace AppBundle\Controller;

trait TestTrait {
    protected function createClass() {
        return new class {
            //We need one T_STRING token after the class keyword to trigger the bug
            public function f() {}
        };
    }
}
```
* Add the trait to the `DefaultController`
```php
class DefaultController extends Controller
{
    use TestTrait;

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
```
* Run we webserver using `bin/console server:run`
* Open `http://127.0.0.1:8000` in the browser
