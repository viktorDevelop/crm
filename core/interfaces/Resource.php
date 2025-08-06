<?php
namespace core\interfaces;

use core\Request;

interface Resource
{
    public function find(Request $request);
    public function update(Request $request);
    public function create(Request $request);
    public function delete(Request $request);
}