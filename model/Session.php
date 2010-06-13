<?

class Session extends MongoModel
{
	const collectionName = "Session";
	
	// _id
	// keywordId
	// url
	// x
	// y
	// query

	function __construct()
	{
		
	}
	
	public static function getById($userSessionId)
	{
		$searchSessionId = $_GET['searchSessionId'];
		
		$collection = MongoModel::getCollection(Session::collectionName);
		
		$query = array("_id"=>new MongoId($searchSessionId));
		
		$session = $collection->findOne($query);
		
		return $session;
	}

	public static function getByKeywordAndQuery($userSessionId)
	{
		$keyword = $_GET['keyword'];
		$query = $_GET['query'];
		
		$collection = MongoModel::getCollection(Session::collectionName);
		
		$query = array("userSessionId"=>$userSessionId,"keyword"=>$keyword, "query"=>$query);
		
		$session = $collection->findOne($query);
		
		if ($session == null)
		{
			$collection->insert($query);
			
			$session = $query;
		}
		
		return $session;
	}

	public static function navigateTo($sessionId)
	{
		$keyword = $_GET['keyword'];
		$searchSessionId = $_GET['searchSessionId'];
		$navigateTo = $_GET['navigateTo'];
		
		// using very rudimentary method here
		// TODO: Use sophisticated method
		
		$collection = MongoModel::getCollection(Session::collectionName);
		
		$query = array("userSessionId"=>$sessionId,"keyword"=>$keyword);
		
		//print $userSessionId."\n";
		//print $keyword."\n";

		$cursor = $collection->find($query);

		$sessionsList = array();
		
		$retSession = null;
		
		$lastSession = null;

		while( $cursor->hasNext() ) {
			$curSession = $cursor->getNext();
			//print $searchSessionId."==".$curSession["_id"]."\n";
			if ($searchSessionId == ($curSession["_id"].""))
			{
				if ($navigateTo == "prev")
				{
					if ($lastSession != null)
					{
						$retSession = $lastSession;
					}
				}
				else if ($navigateTo == "next")
				{
					if ($cursor->hasNext())
					{
						$retSession = $cursor->getNext();
					}
				}
				break;
			}
			$lastSession = $curSession;
		}
		
		if ($retSession == null)
		{
			
		}
		
		return $retSession;	
	}

	public static function getAll($sessionId)
	{
		if (isset($_GET["sessionId"]))
		{
			// handle logic when sessionId is provided
		}
		else
		{
			$keyword = $_GET['keyword'];
			$query = $_GET['query'];

			$collection = MongoModel::getCollection(Session::collectionName);

			$query = array("keyword"=>$keyword, "userSessionId"=>$sessionId);

			$cursor = $collection->find($query);

			$linksList = array();

			while( $cursor->hasNext() ) {
				$linksList[] = $cursor->getNext();
			}

			return $linksList;
		}
	}
}

?>
