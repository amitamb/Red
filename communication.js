if (parent != null)
{
	parent.linkEnterEventHandler = linkEnter;
	parent.linkDraggingEventHandler = linkDragging;
	parent.linkExitEventHandler = linkExit;
	parent.linkDroppedEventHandler = linkDropped;
}
