<?

class Link extends MongoModel
{
	const collectionName = "Link";
	
	// _id
	// keywordId
	// url
	// x
	// y
	// query

	function __construct()
	{
		
	}
	
	public static function add($sessionId)
	{
		$keyword = $_GET['keyword'];
		$url = $_GET['url'];
		$x = $_GET['x'];
		$y = $_GET['y'];
		// no need to store time

		$collection = MongoModel::getCollection(Link::collectionName);
		
		$collection->ensureIndex(array("keyword"=>1, "userSessionId"=>1));

		$link = array("keyword"=>$keyword, "url"=>$url, "x"=>$x, "y"=>$y, "userSessionId"=>$sessionId);

		$collection->save($link);
		
		return (string)$link["_id"];
	}
	
	public static function remove($sessionId)
	{
		$_id = $_GET['_id'];

		$collection = MongoModel::getCollection(Link::collectionName);
		
		$query = array("_id" => new MongoId($_id), "userSessionId"=>$sessionId);
		
		//var_dump($query);
		
		return $collection->remove($query);		
	}

	public static function getAll($sessionId)
	{
		$keyword = $_GET['keyword'];

		$collection = MongoModel::getCollection(Link::collectionName);
		
		$query = array("keyword"=>$keyword, "userSessionId"=>$sessionId);

		$cursor = $collection->find($query);

		$linksList = array();

		while( $cursor->hasNext() ) {
			$linksList[] = $cursor->getNext();
		}

		return $linksList;
	}
}

?>

