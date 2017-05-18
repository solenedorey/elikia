<?php
namespace Sd\Elikia\Secretary;

use Sd\Framework\AbstractClasses\AbstractController;
use Sd\Framework\HttpFoundation\Request;
use Sd\Framework\HttpFoundation\Response;

class SecretaryController extends AbstractController
{
    private $secretaryDb;

    public function __construct(Request $request, Response $response)
    {
        $this->secretaryDb = new SecretaryDb();
        parent::__construct($response, $request);
    }

    /**
     * Action par défaut de l'objet Secretary -> affiche la liste des secrétaires.
     */
    public function home()
    {
        $this->displayList();
    }

    public function displayList()
    {
        $secretaries = $this->secretaryDb->readAll();
        $this->render('secretary/secretariesList.twig', array('secretaries' => $secretaries));
    }

    public function displayDetails()
    {
        $idSecretary = $this->request->getItemGet('idSecretary');
        $secretary = $this->secretaryDb->read($idSecretary);
        $this->render('secretary/secretaryDetails.twig', array('secretary' => $secretary));
    }

    public function edit()
    {
        if (!is_null($this->request->getItemGet('idSecretary'))) {
            $idSecretary = $this->request->getItemGet('idSecretary');
            $secretary = $this->secretaryDb->read($idSecretary);
        } else {
            $secretary = Secretary::createUnknownSecretary();
        }
        $this->render('secretary/SecretaryForm.twig', array('secretary' => $secretary));
    }

    /**
     * Enregistrement d'un nouveau militaire :
     * - récupérer les données POST et les nettoyer
     * - initialiser un objet Secretary avec ces données ou bien lire le militaire en BD et le modifier
     * - instancier un gestionnaire du formulaire
     * - demander au gestionnaire si les données sont valides :
     *     - si oui, enregister le militaire en BD puis l'afficher
     *     - si non, réafficher le formulaire avec les erreurs
     */
    public function save()
    {
        $formData = SecretaryForm::clean($this->request->getPost());
        if (!is_null($this->request->getItemPost('idSecretary'))) {
            $id = (int)$this->request->getItemPost('idSecretary');
            $secretary = $this->secretaryDb->read($id);
            $secretary->updateFromArray($formData);
        } else {
            $secretary = Secretary::createFromArray($formData);
        }
        $form = new SecretaryForm($secretary);
        if ($form->isValid()) {
            $this->secretaryDb->persist($secretary) or die("Problème d'enregistrement en BD");
            $this->render('secretary/secretaryDetails.twig', array('secretary' => $secretary));
        } else {
            $this->render('secretary/secretaryForm.twig', array('secretary' => $secretary, 'errors' => $form->getErrors())
            );
        }
    }

    /**
     * Supprime un article.
     */
    public function delete()
    {
        $id = $_GET['idSecretary'];
        $this->secretaryDb->delete($id);
        $this->displayList();
    }
}