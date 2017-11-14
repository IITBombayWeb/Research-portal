<?php

namespace Drupal\menu_svg_icons\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\menu_svg_icons\IconSetInterface;

/**
 * Defines the IconSet entity.
 *
 * @ConfigEntityType(
 *   id = "menu_svg_icons_icon_set",
 *   label = @Translation("Icon set"),
 *   handlers = {
 *     "list_builder" = "Drupal\menu_svg_icons\Controller\IconSetListBuilder",
 *     "form" = {
 *       "add" = "Drupal\menu_svg_icons\Form\IconSetForm",
 *       "edit" = "Drupal\menu_svg_icons\Form\IconSetForm",
 *       "delete" = "Drupal\menu_svg_icons\Form\IconSetDeleteForm",
 *     }
 *   },
 *   config_prefix = "icon_set",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *   },
 *   links = {
 *     "edit-form" = "/admin/config/media/menu-svg-icons/icon-set/{menu_svg_icons_icon_set}",
 *     "delete-form" = "/admin/config/media/menu-svg-icons/icon-set/{menu_svg_icons_icon_set}/delete",
 *     "collection" = "/admin/config/media/menu-svg-icons",
 *   },
 * )
 */
class IconSet extends ConfigEntityBase implements IconSetInterface {

  /**
   * The IconSet ID.
   *
   * @var string
   */
  public $id;

  /**
   * The IconSet label.
   *
   * @var string
   */
  public $label;

}
