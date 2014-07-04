@extends('layouts.default')
<?php $home = URL::to('/'); ?>
<?php $content = '<h1 style="text-align:center">404</h1><h2 style="text-align:center">Uh oh! I can\'t find that! Maybe try going <a href=\''.$home.'\'>home</a></h2>'; ?>