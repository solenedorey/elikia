<?php
namespace Sd\Elikia\Soldier;

use Sd\Framework\AbstractClasses\AbstractController;
use Sd\Framework\HttpFoundation\Request;
use Sd\Framework\HttpFoundation\Response;

class SoldierController extends AbstractController
{
    private $soldierDb;

    public function __construct(Request $request, Response $response)
    {
        $this->soldierDb = new SoldierDb();
        parent::__construct($response, $request);
    }

    /**
     * Action par défaut de l'objet Soldier -> affiche la liste des militaires.
     */
    public function home()
    {
        $this->displayList();
    }

    public function displayList()
    {
        $this->roleManager->verifyAccess('secretary');
        $soldiers = $this->soldierDb->readAll();
        $gradesList = $this->soldierDb->getAllGrades();
        $this->render('soldier/soldiersList.twig', array('soldiers' => $soldiers, 'grades' => $gradesList));
    }
    
    public function displayListWithFilters() 
    {
        $filterType = $this->request->getItemGet('filter');
        $filterValue = $this->request->getItemGet('value');
        if ($filterType == 'promotion') {
            $soldiersList = $this->soldierDb->soldiersLikelyToUpgrade($filterValue);
        } elseif ($filterType == 'retire') {
            $soldiersList = $this->soldierDb->soldiersLikelyToRetire($filterValue);
        }
        $this->render('soldier/soldiersList.twig', array('soldiers' => $soldiersList));
    }

    public function displayDetails()
    {
        $idSoldier = $this->request->getItemGet('idSoldier');
        $soldier = $this->soldierDb->read($idSoldier);
        $this->render('soldier/soldierDetails.twig', array('soldier' => $soldier));
    }

    public function edit()
    {
        if (!is_null($this->request->getItemGet('idSoldier'))) {
            $idSoldier = $this->request->getItemGet('idSoldier');
            $soldier = $this->soldierDb->read($idSoldier);
        } else {
            $soldier = Soldier::createUnknownSoldier();
        }
        $gradesList = $this->soldierDb->getAllGrades();
        $this->render('soldier/SoldierForm.twig', array('soldier' => $soldier, 'grades' => $gradesList));
    }

    /**
     * Enregistrement d'un nouveau militaire :
     * - récupérer les données POST et les nettoyer
     * - initialiser un objet Soldier avec ces données ou bien lire le militaire en BD et le modifier
     * - instancier un gestionnaire du formulaire
     * - demander au gestionnaire si les données sont valides :
     *     - si oui, enregister le militaire en BD puis l'afficher
     *     - si non, réafficher le formulaire avec les erreurs
     */
    public function save()
    {
        $formData = SoldierForm::clean($this->request->getPost());
        if (!is_null($this->request->getItemPost('idSoldier'))) {
            $id = (int)$this->request->getItemPost('idSoldier');
            $soldier = $this->soldierDb->read($id);
            $soldier->updateFromArray($formData);
        } else {
            $soldier = Soldier::createFromArray($formData);
        }
        $form = new SoldierForm($soldier);
        if ($form->isValid()) {
            $this->soldierDb->persist($soldier) or die("Problème d'enregistrement en BD");
            $this->render('soldier/soldierDetails.twig', array('soldier' => $soldier));
        } else {
            $this->render('soldier/soldierForm.twig', array('soldier' => $soldier, 'errors' => $form->getErrors())
            );
        }
    }

    /**
     * Supprime un article.
     */
    public function delete()
    {
        $id = $_GET['idSoldier'];
        $this->soldierDb->delete($id);
        $this->displayList();
    }
}