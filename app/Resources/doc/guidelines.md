# Guidelines

## Routing

Chaque controller a son propre fichier de routing.

```YAML
# app/config/routing.yml

ndc_hello_bundle:
    resource: "@NDCHelloBundle/Resources/config/routing.yml"
    prefix:   /
```

```YAML
# src/NDC/HelloBundle/Resources/config/routing.yml

ndc_hello_bundle_controller_name:
    resource: routing/controllerName.yml
    prefix: /my/prefix
```

```YAML
# src/NDC/HelloBundle/Resources/config/routing/controllerName.yml

hello_controller_name_action:
    pattern: /my/route
    defaults: { _controller: HelloBundle:ControllerName:action }
```

## Controller

### Injection de services

Pour les services les plus utilisés, s'appuyer sur l'injection de services dans les attributs.

```PHP
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\Paginator;

class MyController extends Controller
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var Paginator
     */
    private $paginator;
}
```

Ne pas oublier d'enregistrer le bundle dans app/config/config.yml
```YAML
jms_di_extra:
    locations:
        bundles: [NDCHelloBundle]
```

### Annotation @Template

Utiliser l'annotation *@Template* pour render une view.

```PHP
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MyController extends Controller
{
    /**
     * @Template
     */
    public function indexAction()
    {
        return array(
        );
    }
}
```

## Entities

* Les entités sont mapées en YAML.
* Le nom de la table commence toujour par *ndc_* et est en snack_case
* Le repository est dans le dossier **Repository** du bundle et pas dans le dossier **Entity**
* Le nom des champs est en camelCase et le nom des colones en snack_case

```YAML
NDC\HelloBundle\Entity\MyEntity:
    type: entity
    table: ndc_my_entity
    repositoryClass: NDC\HelloBundle\Repository\MyEntityRepository
    id:
        id:
            type: integer
            id: true
            generator:
                strategy: AUTO
    fields:
        myField:
            column: my_field
            type: integer
```