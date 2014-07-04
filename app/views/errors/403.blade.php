@extends('layouts.default')
<?php $home = URL::to('/') ?>
<?php $content = '<h1 style="text-align:center">403</h1><h2 style="text-align:center">It appears you shouldn\'t be here, try going <a href="'.$home.'">home</a></h2>'; ?>