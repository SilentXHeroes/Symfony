<?php

namespace App\Controller;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\Cache\CacheInterface;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class QuestionController extends AbstractController
{
	/**
	 * @Route("/", name="app_homepage")
	 */
	public function homepage(Environment $twigEnv)
	{
		/*
		// fun example of using the Twig service directly
		$html = $twigEnv->render("question/homepage.html.twig");
		return new Response($html);
		*/
		return $this->render("question/homepage.html.twig");
	}

	/**
	 * @Route("/questions/{slug}", name="app_question_show")
	 */
	public function show($slug, MarkdownParserInterface $markdownParser, CacheInterface $cache) {
		$answers = [
			"Réponse numéro 1",
			"Réponse numéro 2 un peu `plus` vénère",
			"Réponse numéro 3 EXTREMEMENT VENERE WOUAH"
		];

		$questionText = "I've been turned into a cat, any *thoughts* on how to turn back? While I'm **adorable**, I don't really care for cat food.";

		$parsedQuestionText = $cache->get('markdown_'.md5($questionText), function() use ($questionText, $markdownParser) {
			return $markdownParser->transformMarkdown($questionText);
		});

		dd($markdownParser);

		return $this->render('question/show.html.twig', [
			'question' => ucwords(str_replace('-', ' ', $slug)),
			'answers' => $answers,
			'questionText' => $parsedQuestionText
		]);
	}
}