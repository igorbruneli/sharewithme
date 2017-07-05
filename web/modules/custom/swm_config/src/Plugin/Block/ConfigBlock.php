<?php

namespace Drupal\swm_config\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;

/**
 * Provides a Configurable Block.
 *
 * @Block(
 *   id = "config_block",
 *   admin_label = @Translation("Config Block")
 * )
 */
class ConfigBlock extends BlockBase implements BlockPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $blockConfig = $this->getConfiguration();
    $label = $blockConfig['label'];

    $language = \Drupal::languageManager()->getCurrentLanguage()->getId();

    $info = $this->getBlockInfo($label, $language);

    $block = array(
      '#theme' => isset($info['theme']) ? $info['theme'] : 'swm_theme_config_block',
      '#title' => @$info['title'][$language],
      '#text' => @$info['text'][$language],
      '#img' => @$info['img'],
      '#attr' => array_merge(['class' => 'config-block-container'], isset($info['attr']) ? $info['attr'] : []),
    );

    return $block;
  }

  /**
   * Get information for the block
   * @todo get this information from custom settings
   *
   * @global type $base_url
   * @param type $label
   * @param type $language
   * @return string
   *
   */
  private function getBlockInfo($label, $language) {
    global $base_url;

    $imgPath = \Drupal::theme()->getActiveTheme()->getPath();

    switch ($label) {
      case 'Accessing law and accepting submissions Block':
        return [
          'title' => [
            'fr' => 'Divulga&ccedil;&atilde;o da lei e Submiss&otilde;es',
            'en' => 'Accessing law and accepting submissions',
          ],
          'text' => [
            'fr' => '<p>A CRL promove ac&ccedil;&otilde;es orientadas para a eleva&ccedil;&atilde;o da consci&ecirc;ncia jur&iacute;dica dos cidad&atilde;os, encorajando a divulga&ccedil;&atilde;o e dissemina&ccedil;&atilde;o das leis pelas respectivas institui&ccedil;&otilde;es, em raz&atilde;o da sua responsabilidade social.</p><p>A CRL aceita e analisa submiss&otilde;es por parte de cidad&atilde;os e organiza&ccedil;&otilde;es, na perspectiva de uma poss&iacute;vel melhoria legislativa.</p><p>Recebe ainda propostas por parte de peritos que, encorajados a colaborar, ampliam a capacidade de reforma num processo transversal.</p><p>A reforma &eacute; de todos n&oacute;s.</p>',
            'en' => '<p>The LRC promotes and raises citizens&rsquo; legal awareness, encouraging dissemination of laws by the institutions based on their specific social responsibilities. The LRC accepts and analysis submissions by citizens and organizations, as an opportunity for law improvement. It also receives proposals by experts encouraged to collaborate and thus enhancing the reform in a crosscutting process.</p><p>The reform belongs to us all.</p>',
          ],
          'img' => $imgPath . '/images/blocks/accessing_law_accepting_submissions.png',
          'attr' => ['id' => 'accessing_law_and_accepting_submissions', 'class' => 'tl-col-6-6 tl-col-6-6--reverse config-block-container'],
        ];

      case 'Custom title Block':
        $node = \Drupal::routeMatch()->getParameter('node');
        return [
          'title' => [
            'fr' => $node->title->value,
            'en' => $node->title->value,
          ],
          'attr' => ['id' => 'custom-node-title'],
        ];

      case 'Create a group Block':
        return [
            'text' => [
                'fr' => '<a href="'.$base_url.'/group/add">Create a group</a>',
                'en' => '<a href="'.$base_url.'/group/add">Create a group</a>',
            ],
            'attr' => ['id' => 'create-group-link'],
        ];
        
    }
  }

}
