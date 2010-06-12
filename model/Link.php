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
		$searchSessionId = $_GET["searchSessionId"];
		$url = $_GET['url'];
		$x = $_GET['x'];
		$y = $_GET['y'];

		$collection = MongoModel::getCollection(Link::collectionName);
		
		$collection->ensureIndex(array("searchSessionId"=>1, "userSessionId"=>1));

		$link = array("searchSessionId"=>new MongoId($searchSessionId), "url"=>$url, "x"=>$x, "y"=>$y, "userSessionId"=>$sessionId);

		$collection->save($link);
		
		return (string)$link["_id"];
	}

	public static function addOld($sessionId)
	{
		$keyword = $_GET["keyword"];
		$query = $_GET["query"];
		$searchSessionId = $_GET["searchSessionId"];
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
			$link = null;
			
			$link = $cursor->getNext();
			
			if ($link["url"] != "")
			{
				$linksList[] = $link; //$cursor->getNext();
			}
			else
			{
				// print "alert('".$collection->remove(array("_id"=>new MongoId($link["_id"])))."');";
			}
		}

		return $linksList;
	}
	
	public static function getAllBySearchSessionId($sessionId, $searchSessionId)
	{
		// For $sesionId and searchSessionId
		// obtain all links
		$keyword = $_GET['keyword'];

		$collection = MongoModel::getCollection(Link::collectionName);

		$query = array("userSessionId"=>$sessionId, "searchSessionId"=>$searchSessionId);

		$cursor = $collection->find($query);

		$linksList = array();

		while( $cursor->hasNext() ) {
			$linksList[] = $cursor->getNext();
		}

		return $linksList;
	}
}

?>

