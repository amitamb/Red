<?

class User extends MongoModel
{
	const collectionName = "User";
	
	// _id
	// username
	// epassword
	// email (optional)

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
		
		return $link;
	}

	public static function getAll($sessionId)
	{
		$keyword = $_GET['keyword'];
		
		//print "astasxf";
		//print $sessionId;

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

