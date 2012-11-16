<?php

/**
 * This command displays a simple welcome page.
 *
 * @package demo.commands
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
class DefaultCommand implements ICommand
{
    public function execute(IRequest $request, IResponse $response)
    {
        $view = new HtmlTemplateView(__APP_PATH . 'views/default.php');
        if ($request->issetParameter('name')) {
            $view->assign('name', $request->getParameter('name'));
        }
        $response->write($view->parse());
    }
}