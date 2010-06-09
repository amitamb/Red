<?

class CommonLink extends Model
{
	const collectionName = "Keyword";
	
	// _id
	// url
	// name
	// iconUrl
	// userId
	// keywordId
	
	function __construct()
	{
		
	}

	public static function add()
	{
		$keyword = $_POST['keyword'];
		
		$collection = MongoModel::getCollection(Keyword::collectionName);
		
		$collection->ensureIndex(array("str"=>1, "userSessionId"=>1));

		$keyword = array("str"=>$keyword, "userSessionId"=>$sessionId);

		$collection->save($keyword);
	}
}

?>
