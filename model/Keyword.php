<?

class Keyword extends MongoModel
{
	const collectionName = "Keyword";

	function __construct()
	{
		
	}

	public static function add($sessionId)
	{
		$keyword = $_POST['keyword'];
		
		$collection = MongoModel::getCollection(Keyword::collectionName);
		
		$collection->ensureIndex(array("str"=>1, "userSessionId"=>1));

		$keyword = array("str"=>$keyword, "userSessionId"=>$sessionId);

		$collection->save($keyword);	
	}
	
	public static function remove($sessionId)
	{
		$_id = $_POST['_id'];
		
		$collection = MongoModel::getCollection(Keyword::collectionName);

		$keyword = array("_id"=> new MongoId($_id), "userSessionId"=>$sessionId);

		$collection->remove($keyword);
	}
	
	public static function getKeywords($sessionId)
	{
		$collection = MongoModel::getCollection(Keyword::collectionName);
		
		$query = array("userSessionId"=>$sessionId);

		$cursor = $collection->find($query);

		$keywordsList = array();

		while( $cursor->hasNext() ) {
			$keywordsList[] = $cursor->getNext();
		}

		return $keywordsList;
	}
}

?>
