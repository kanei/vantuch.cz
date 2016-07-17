<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
/**
 * Description of BlogPosting
 *
 * @author mark
 */
class HunchSchema_Post extends HunchSchema_Page {
    
    public $schemaType = "BlogPosting";

    public function getResource($pretty = false) {
        parent::getResource($pretty);
        $this->schema['@type'] = $this->schemaType;

        // Get the Categories
        $categories = get_the_category();
        if (count($categories) > 0) {
            foreach ($categories AS $category) {
                $categoryNames[] = $category->name;
            }
            $this->schema['about'] = $categoryNames;
        }

		$this->schema['keywords'] = $this->getTags();
		$this->schema['commentCount'] = get_comments_number();
		$this->schema['comment'] = $this->getComments();

        return $this->toJson($pretty);

    }
}
