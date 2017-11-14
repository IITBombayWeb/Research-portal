<?php

namespace Drupal\menu_svg_icons\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Entity\Query\QueryFactory;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form controller for icon set forms.
 */
class IconSetForm extends EntityForm {

  /**
   * Constructs an IconSetForm object.
   *
   * @param \Drupal\Core\Entity\Query\QueryFactory $entity_query
   *   The entity query.
   */
  public function __construct(QueryFactory $entity_query) {
    $this->entityQuery = $entity_query;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.query')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $icon_set = $this->entity;

    $form['#title'] = $this->operation == 'add' ? $this->t('Add icon set')
        :
        $this->t('Edit %label icon set', ['%label' => $icon_set->label()]);

    $form['label'] = [
      '#title' => $this->t('Name'),
      '#type' => 'textfield',
      '#default_value' => $icon_set->label,
      '#description' => $this->t('The human-readable name of this icon set. This name must be unique.'),
      '#required' => TRUE,
      '#size' => 30,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $icon_set->id(),
      '#machine_name' => [
        'exists' => [$this, 'exist'],
      ],
      '#disabled' => !$icon_set->isNew(),
      '#description' => $this->t('A unique machine-readable name for this icon set. It must only contain lowercase letters, numbers, and underscores.'),
    ];

    $form['description'] = [
      '#title' => $this->t('Description'),
      '#type' => 'textarea',
      '#default_value' => $icon_set->description,
      '#description' => $this->t('Describe this icon set.'),
    ];

    $form['placement'] = [
      '#title' => $this->t('Icon placement'),
      '#type' => 'radios',
      '#options' => [
        'left' => $this->t('Left'),
        'right' => $this->t('Right'),
      ],
      '#default_value' => ($icon_set->placement ? $icon_set->placement : 'left'),
      '#description' => $this->t('Define the icon placement.'),
    ];

    $form['source'] = [
      '#title' => $this->t('Icon source'),
      '#type' => 'textarea',
      '#rows' => 15,
      '#default_value' => $icon_set->source,
      '#description' => $this->t('Paste your svg sprite code'),
      '#required' => TRUE,
    ];

    $form['icon_height'] = [
      '#title' => $this->t('Icon height'),
      '#type' => 'number',
      '#default_value' => ($icon_set->icon_height ? $icon_set->icon_height : ''),
      '#description' => $this->t('Define height on icons. If no value is set, fallback to css rules'),
    ];

    $form['icon_width'] = [
      '#title' => $this->t('Icon width'),
      '#type' => 'number',
      '#default_value' => ($icon_set->icon_width ? $icon_set->icon_width : ''),
      '#description' => $this->t('Define height on icons. If no value is set, fallback to css rules'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $icon_set = $this->entity;
    $status = $icon_set->save();

    if ($status) {
      drupal_set_message($this->t('Saved the %label Icon set.', [
        '%label' => $icon_set->label(),
      ]));
    }
    else {
      drupal_set_message($this->t('The %label Icon set was not saved.', [
        '%label' => $icon_set->label(),
      ]));
    }

    $form_state->setRedirect('entity.menu_svg_icons_icon_set.collection');
  }

  /**
   * Helper function to check whether an IconSet configuration entity exists.
   */
  public function exist($id) {
    $entity = $this->entityQuery->get('menu_svg_icons_icon_set')
      ->condition('id', $id)
      ->execute();
    return (bool) $entity;
  }

}
