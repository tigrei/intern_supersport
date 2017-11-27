<?php 

namespace Drupal\casestudies\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;

include_once('sites/all/libraries/simplehtmldom/simple_html_dom.php');

/**
 * Implements an example form.
 */
class CaseStudiesForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'casestudies_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

		$header = [
		  'title' => $this->t('Title'),
		  'body' => $this->t('Body'),
		  'success' => $this->t('Success'),
		];

		$options = [];
		$count = 1;
	  $html = file_get_html('https://www.achieveinternet.com/case-studies');
		foreach($html->find('a') as $element) {
			if(strpos($element->href, "portfolio"))	{
      	$link = "https://www.achieveinternet.com" . $element->href;
				$html2 = file_get_html($link);		
				$title = $html2->find('div[class="field__item even"]');
				$body = $html2->find('div[class="field field--name-field-solution field--type-text-long field--label-hidden"]');
				$success = $html2->find('div[id="md3"] div[class="field__item even"] p');
				if ($success == NULL)
					$options[$count] = ['title' => $title[0]->plaintext, 'body' => $body[0]->plaintext, 'success' => 'Great Success!'];
				else
					$options[$count] = ['title' => $title[0]->plaintext, 'body' => $body[0]->plaintext, 'success' => $success[0]->plaintext];
				if ($options[$count]==$options[$count-1])
					$count--;
				$count ++;
			}
	  }
		

		$form['table'] = array(
		  '#type' => 'tableselect',
		  '#header' => $header,
		  '#options' => $options,
		  '#empty' => $this->t('No case studies found!'),
		);

		$form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#button_type' => 'primary',
    );

		return $form;
  }
  
  public function submitForm(array &$form, FormStateInterface $form_state) {	
    $values = $form_state->getValues();
    foreach ($values as $key => $value) {
	    if (is_array($value)) {
	        $value = array_filter($value);
	    }
	    foreach ($value as $nid)	{
			  $node = Node::create(array(
			    'type' => 'article',
			    'title' => $form['table']['#options'][$nid]['title'],
			    'body' => $form['table']['#options'][$nid]['body'],
			    'langcode' => 'en',
			    'uid' => $nid,
			    'status' => 1,
			    'field_fields' => array(),
				));
				$node->save();
	    	}
	    drupal_set_message('Your content has been successfully created.');
    }
  }
}