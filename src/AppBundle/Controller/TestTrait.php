<?php

/*
 * This file is part of the router-test project.
 *
 * @author     pierre
 * @copyright  Copyright (c) 2018
 */

namespace AppBundle\Controller;

trait TestTrait {
    protected function createClass() {
        return new class {
            //We need one T_STRING token after the class keyword to trigger the bug
            public function f() {}
        };
    }
}