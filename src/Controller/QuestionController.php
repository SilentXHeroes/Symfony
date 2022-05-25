<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController
{
	/**
	 * @Route("/")
	 */
	public function homepage()
	{
		return new Response('Some text !');
	}

	/**
	 * @Route("/questions/{slug}")
	 */
	public function show($slug) {
		return new Response(sprintf('Future page "%s" !', str_replace('-', ' ', $slug)));
	}
}