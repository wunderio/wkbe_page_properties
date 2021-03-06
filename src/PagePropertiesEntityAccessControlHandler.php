<?php

/**
 * @file
 * Contains \Drupal\wkbe_page_properties\PagePropertiesEntityAccessControlHandler.
 */

namespace Drupal\wkbe_page_properties;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Page properties entity.
 *
 * @see \Drupal\wkbe_page_properties\Entity\PagePropertiesEntity.
 */
class PagePropertiesEntityAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished page properties entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published page properties entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit page properties entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete page properties entities');
    }

    return AccessResult::allowed();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add page properties entities');
  }

}
