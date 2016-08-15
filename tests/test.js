"use strict";
define(["model"],function($model){
	return new $model(
			{
			  "meta": {
			    "title": "Test title"
			  },
			  "data": [
			    {
			      "id": 1,
			      "name": "Ben Louie Casapao",
			      "section": "IV-1"
			    },
			    {
			      "id": 2,
			      "name": "Sarah Joy Leuterio",
			      "section": "III-2"
			    }
			  ]
			}
		);
		//test.setMeta({title:"Test"});
		//test.setData([{title:"Sample","description":"dasd"}]);
		/*
		test.GET = function(){
			return {success:test.list()};
		}
		test.POST = function(data){
			return {success:test.save(data)};
		}
		*/
});