<?php
namespace Natalie;

interface Routes 
{
    public function getRoutes(): array;
    public function getAuthentication(): \Natalie\Authentication;
}