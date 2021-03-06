<?php

declare(strict_types=1);

namespace Meetup\Controller;

use Meetup\Entity\Meetup;
use Meetup\Repository\MeetupRepository;
use Meetup\Form\MeetupForm;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Element\Date;

final class IndexController extends AbstractActionController
{
    /**
     * @var MeetupRepository
     */
    private $MeetupRepository;

    /**
     * @var MeetupForm
     */
    private $MeetupForm;

    public function __construct(MeetupRepository $MeetupRepository, MeetupForm $MeetupForm)
    {
        $this->MeetupRepository = $MeetupRepository;
        $this->MeetupForm = $MeetupForm;
    }

    public function indexAction()
    {
        return new ViewModel([
            'meetups' => $this->MeetupRepository->findAll(),
        ]);
    }

    public function addAction()
    {
        $form = $this->MeetupForm;

        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {

                $Meetup = $this->MeetupRepository->createMeetup(
                    $form->getData()['title'],
                    $form->getData()['description'] ?? '',
                    $form->getData()['organisateur'],
                    $form->getData()['entreprise'],
                    $form->getData()['startDate'],
                    $form->getData()['endDate'],
                    $form->getData()['participant']
                );
               
                $this->MeetupRepository->add($Meetup);
                return $this->redirect()->toRoute('meetup');
            }
        }

        $form->prepare();
 
        return new ViewModel([
            'form' => $form,
        ]);
    }

    public function postAction()
    {
        $id = $this->params()->fromRoute('id');

        $meetup = $this->MeetupRepository->findOneBy(['id' => $id]);

        if ($meetup == null)
        {
            return $this->redirect()->toRoute('meetup');
        }

        return new ViewModel([
            'meetup' => $meetup,
        ]);
    }

    public function editAction()
    {

        $form = $this->MeetupForm;
        $id = $this->params()->fromRoute('id');
        $meetup = $this->MeetupRepository->find($id);
        $form->bind($meetup);

        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->meetupRepository->updateMeetup($form->getData());
                return $this->redirect()->toRoute('meetup');
            }
        }

        $form->prepare();

        return new ViewModel([
            'form' => $form,
            'meetup' => $meetup,
        ]);
    }


    public function deleteAction()
    {
        /* @var $request Request */
        $request = $this->getRequest();
        /** @var $id string */
        $id = (string)$request->getPost('id');
        if (empty($id)) {
            die("error");
        }

        $this->MeetupRepository->delete($id);
        return $this->redirect()->toRoute('meetup');
    }
}
