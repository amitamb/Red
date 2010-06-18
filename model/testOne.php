<?

require "morph/Morph.phar";

class testOne extends Morph_Object
{
	public function __construct($id = null)
    {
        parent::__construct($id);
        $this->addProperty(new Morph_Property_String('title'))
             ->addProperty(new Morph_Property_String('author'))
             ->addProperty(new Morph_Property_Integer('pageNumber'))
             ->addProperty(new Morph_Property_Date('publishedDate'));
    }

}

?>
