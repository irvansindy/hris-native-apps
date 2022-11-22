(function ($) {
	// Extend jQuery for copy attributes
	$.fn.copyAttributes = function (elem) {
		$this = $(this);
		$.each($(elem).prop('attributes'), function () {
			if (this.name != 'class') 
				$this.attr(this.name, this.value);
		});
		return $this;
	};

	$.fn.jOrgChart = function (options) {
		var opts = $.extend({}, $.fn.jOrgChart.defaults, options);
		var $appendTo = $(opts.chartElement);
		

		// build the tree
		var $this = $(this);
		var $container = $("<div class='" + opts.chartClass + "'/>");
		
		if ($this.is("ul")) {
			buildNode($this.find("li:first"), $container, 0, opts);
		}
		else if ($this.is("li")) {
			buildNode($this, $container, 0, opts);
		}
		
		$appendTo.append($container);
	};

	// Option defaults
	$.fn.jOrgChart.defaults = {
		chartElement : 'body',
		depth      : -1,
		chartClass : "jOrgChart",
		nodeClicked: function ($node, type) {}
	};
	
	var nodeCount = 0;
	
	// Method that recursively builds the tree (horizontal type)
	function buildNode($node, $appendTo, level, opts) {

		var $divid  = $("<div class='printtest1' id='printtest1'/>");
		var $table = $("<table cellpadding='0' cellspacing='0' border='0' id='testprint'>");
		var $tbody = $("<tbody/>");

		// Construct the node container(s)
		var $nodeRow = $("<tr/>").addClass("node-cells");
		var $rowGrade = $("<td>").addClass("grade");
		var $c1 = $($node.clone("li")).attr("id1");
		
		var $nodeCell = $("<td/>").addClass("node-cell").attr("colspan", 2);
		//
		var $childContainer = $node.children("ul:first");
		var $childContainerX = $node.parent("ul");
		// alert($childContainerX);
		var isVerticalNodes = ($childContainer.attr('type') == 'vertical');		
		
		// 
		// var $c = $($childContainerX.children("li")).attr("id");
		// var $h = document.getElementById("gradex").value;

		// var $c = $("#hehe").value;

		
		var $childNodes = $childContainer.children("li");
		var $childNodes1 = $childContainerX.children("li");
		var testlengt = $childNodes.length;
		var $childNodesCount = !isVerticalNodes ? $childNodes.length : 0;
		var $nodeDiv;
		var $Grade;

		if ($childNodesCount > 1) {
			if($c1 != '2'){
				$nodeCell.attr("colspan", $childNodesCount * 2);
			}
		}
		var $c = $($node.clone("li")).attr("id");
		var $c2 = $($node.clone("li")).attr("id2");
		var $c3 = $($node.clone("li")).attr("id3");
		var $c4 = $($node.clone("li")).attr("id4");
		var $view = document.getElementById("tampungfilter").value;
		var $namadept = document.getElementById("namadept1").value;
		var $orderid = document.getElementById("orderid").value;
		var $level = document.getElementById("tampunglevel").value;
		var $namadept1 = document.getElementById("tampungdept").value;
		var $namadiv = document.getElementById("tampungdiv").value;
		var $namadir = document.getElementById("tampungdir").value;


		// Draw the node
		// Get the contents - any markup except li and ul allowed
		var $nodeContent = $node.clone()
								.children("ul,li")
								.remove()
								.end()
								.html();
		$nodeContent = wrapContent($nodeContent);
		if($c == '1'){
			var imageicon1	= $('<div ></div>');
		}else{
			if($c2 != ''){
				var imageicon1	= $('<div><img class="imageicon" style="height:90px;width:72px; margin-left:10px; margin-right:10px; margin-top:10px" src="images/user/'+$c2+'"/></div>');
			}else{
				var imageicon1	= $('<div><img class="imageicon" style="height:90px;width:72px; margin-left:10px; margin-right:10px; margin-top:10px" src="images/user1.png"/></div>');
			}

		}
		

		if($c == '1'){
			if($c1 == '2'){
				var wrapper	= $("<table cellpadding='0' cellspacing='0' border='0'/>")
				// var $table1 = $("<table cellpadding='0' cellspacing='0' border='0'/>");
				var $tbody1 = $("<tbody/>");
				var $nodeRow1 = $("<tr/>");
				var $nodeCell1 = $("<td class='gariskiri2' />");
				var $nodeCell2 = $("<td class='gariskanan3' />");
				// $nodeCell2.append(imageicon1);
				$nodeRow1.append($nodeCell1).append($nodeCell2);
				$tbody1.append($nodeRow1);
				// $table1.append($tbody1);
				wrapper.append($tbody1);
			}else{
				var wrapper	= $("<table/>")
				// var $table1 = $("<table cellpadding='0' cellspacing='0' border='0'/>");
				var $tbody1 = $("<tbody/>");
				var $nodeRow1 = $("<tr/>");
				var $nodeCell1 = $("<td class='gariskiri'/>");
				var $nodeCell2 = $("<td class='gariskanan'/>");
				// $nodeCell2.append(imageicon1);
				$nodeRow1.append($nodeCell1).append($nodeCell2);
				$tbody1.append($nodeRow1);
				// $table1.append($tbody1);
				wrapper.append($tbody1);
			}
		}else{
			if($c2 != ''){
				var wrapper	= $('<span data-toggle="modal" id="modal_profile" id1="'+$c4+'" data-target="#modal-default">')
			}else{
				var wrapper	= $('<span data-toggle="modal" data-target="#modal-defaulthahaha">')
			}
			if($c3 != '0'){
				var $table1 = $("<table cellpadding='0' cellspacing='0' border='0'/>");
			}else{
				var $table1 = $("<table align='center' cellpadding='0' cellspacing='0' border='0'/>");
			}
			var $tbody1 = $("<tbody/>");
			var $nodeRow1 = $("<tr/>");
			var $nodeCell1 = $("<td/>");
			var $nodeCell2 = $("<td/>");
			$nodeCell2.append(imageicon1);
			if($c3 != '0'){
				$nodeRow1.append(imageicon1).append($nodeContent);
			}else{
				$nodeRow1.append($nodeContent);

			}
			$tbody1.append($nodeRow1);
			$table1.append($tbody1);
			wrapper.append($table1);
		}
		// wrapper.append($ahref);
		
		//document.write(commentName);						
		//Increments the node count which is used to link the source list and the org chart
		nodeCount++;
		var $gradex = 1;
		// var c = document.getElementById("gradex").value;
		$node.data("tree-node", nodeCount);
		// var printError = function(error, explicit) {
		// 	console.log(`[${explicit ? 'EXPLICIT' : 'INEXPLICIT'}] ${error.name}: ${error.message}`);
		// }
		
		// try {
		// 	// Accessing `firstName` is now allowed
		// 	var length = $c.length;
		// 	console.log(`Length is ${length}.`)
		// } catch (e) {
		// 	if (e instanceof ReferenceError) {
		// 		printError(e, true);
		// 	} else {
		// 		printError(e, false);
		// 	}
		// }
		// if (typeof $c !== 'undefined'){
			// alert($c);
			// alert($c2);
			// alert($view);
		// }else{
			// alert($c1);
		// }
		// alert($childNodesCount);

		// if (typeof $c === "undefined") {
		// 	txt = "x is undefined";
		//   } else {
		// 	txt = "x is defined";
		//   }
		// $Grade = $('<input class="grade" value="Test1">')
		// $nodeCell.append($Grade);
		var br	= $("<br>");
		var imageicon	= $('<div><img class="imageicon" style="height:50px;width:50px" src="images/user.png"/></div>');
		
		if($c == '1'){
			if($c1 == '2'){
				$nodeDiv = $("<div>").addClass("kotakkosong1")
							.copyAttributes($node)
							.data("tree-node", nodeCount)
							.append(wrapper);
			}else{
				$nodeDiv = $("<div>").addClass("noda")
							.copyAttributes($node)
							.data("tree-node", nodeCount)
							.append(wrapper);
			}
		}else{
			$nodeDiv = $("<div>").addClass("node")
			.copyAttributes($node)
			.data("tree-node", nodeCount)
			.append(wrapper);
		}

        $tablee     = $("<table>");
        $trr        = $("<tr>")

        // $trr.append($nodeDiv);
        // $tablee.append($trr);
		$nodeCell.append($nodeDiv);	
        // $nodeCell.append($tablee);		
	
		//document.write($nodeDiv);
		if (isVerticalNodes && $childNodes.length > 0) {
			$nodeDiv.addClass("vertical");
			var $verticalNodeDiv = $("<div>").addClass("multi-tree");			
			buildVerticalTree($childContainer, $verticalNodeDiv, opts);			
			$nodeDiv.after($verticalNodeDiv);
		}		
		// alert($childNodesCount);
		if ($childNodesCount > 0) {
			// $tablee     = $("<table>");
            // $trr        = $("<tr>");
            // $trrr       = $("<tr>");
			// if it can be expanded then change the cursor
			if($c != '1'){
				if($c1 != '2'){
					$nodeCell.append('<div><img id="" class="cover" src="images/orgchart.minus.png"/></div>');
					// Buat Summary Kasih Kondisi
					if($view == '2'){
						if($namadept1 == '0' && $namadiv == '0' && $namadir != '0'){
								// alert('1');
							
								if($c3 >= 6 && $c3 <= 7){
									var $those	= $nodeDiv;
									var $tr1	= $those.closest("tr");
									$tr1.removeClass('expanded').addClass('contracted');
									$tr1.nextAll("tr").css('display', 'none');
									$node.addClass('collapsed');
								}

								if($c3 == '9'){
									var $those	= $nodeDiv;
									var $tr1	= $those.closest("tr");
									$tr1.removeClass('expanded').addClass('contracted');
									$tr1.nextAll("tr").css('display', 'none');
									$node.addClass('collapsed');
								}

								if($c3 == '12'){
									var $those	= $nodeDiv;
									var $tr1	= $those.closest("tr");
									$tr1.removeClass('expanded').addClass('contracted');
									$tr1.nextAll("tr").css('display', 'none');
								}
						}else if($namadept1 == '0' && $namadiv != '0' && $namadir != '0'){
								// alert('2');

								if($c3 == '9'){
									var $those	= $nodeDiv;
									var $tr1	= $those.closest("tr");
									$tr1.removeClass('expanded').addClass('contracted');
									$tr1.nextAll("tr").css('display', 'none');
									$node.addClass('collapsed');
								}

								if($c3 == '12'){
									var $those	= $nodeDiv;
									var $tr1	= $those.closest("tr");
									$tr1.removeClass('expanded').addClass('contracted');
									$tr1.nextAll("tr").css('display', 'none');
									$node.addClass('collapsed');
								}
						
						}else if($namadept1 != '0' && $namadiv != '0' && $namadir != '0'){
							// alert('3');

							if($c3 == '12'){
								var $those	= $nodeDiv;
								var $tr1	= $those.closest("tr");
								$tr1.removeClass('expanded').addClass('contracted');
								$tr1.nextAll("tr").css('display', 'none');
								$node.addClass('collapsed');
							}
						}else if($namadept1 != '0' && $namadiv == '0' && $namadir != '0'){
							// alert('5');

							if($c3 == '12'){
								var $those	= $nodeDiv;
								var $tr1	= $those.closest("tr");
								$tr1.removeClass('expanded').addClass('contracted');
								$tr1.nextAll("tr").css('display', 'none');
								$node.addClass('collapsed');
							}
						}
					}else if($view == '0'){
						if($level == '2'){
							if($orderid < 9){
								if($c3 == '9'){
									var $those	= $nodeDiv;
									var $tr1	= $those.closest("tr");
									$tr1.removeClass('expanded').addClass('contracted');
									$tr1.nextAll("tr").css('display', 'none');
									$node.addClass('collapsed');
								}
							}
						}else if($level == '1'){
							if($c3 == '7'){
								var $those	= $nodeDiv;
								var $tr1	= $those.closest("tr");
								$tr1.removeClass('expanded').addClass('contracted');
								$tr1.nextAll("tr").css('display', 'none');
								$node.addClass('collapsed');
							}
						}
					}else if($view == '1'){
						if($c3 == '12'){
							var $those	= $nodeDiv;
							var $tr1	= $those.closest("tr");
							$tr1.removeClass('expanded').addClass('contracted');
							$tr1.nextAll("tr").css('display', 'none');
							$node.addClass('collapsed');
						}
					}
					
					// Buat Summary Kasih Kondisi
				}
			}
		}
										 
		// Expand and contract nodes
		if ($childNodesCount > 0) {		
			if($c != '1'){
				// alert($c);
				$nodeDiv.next().children('img.cover').click(function () {
					var $this = $nodeDiv;
					var $tr = $this.closest("tr");

					

					if ($tr.hasClass('contracted')) {
						$tr.removeClass('contracted').addClass('expanded');
						$tr.nextAll("tr").css('display', '');
						$(this).attr('src', 'images/orgchart.minus.png');
						$(this).attr('id', 'gambarminus');
						// Update the <li> appropriately so that if the tree redraws collapsed/non-collapsed nodes
						// maintain their appearance
						$node.removeClass('collapsed');
					} else {
						$tr.removeClass('expanded').addClass('contracted');
						$tr.nextAll("tr").css('display', 'none');
						$(this).attr('src', 'images/orgchart.plus.png');
						$(this).attr('id', 'gambarplus');
						$node.addClass('collapsed');
					}
				});	
			}
		}

		$nodeRow.append($nodeCell);
		$tbody.append($nodeRow);

		if ($childNodesCount > 0) {
			// recurse until leaves found (-1) or to the level specified
			if (opts.depth == -1 || (level + 1 < opts.depth)) { 
				var $downLineRow = $("<tr/>");
				var $downLineCell = $("<td/>").attr("colspan", $childNodesCount * 2);
				$downLineRow.append($downLineCell);


				// draw the connecting line from the parent node to the horizontal line 
				if($c1 != '2'){
					$downLine = $("<div class='line down'/>");
					var wrapper	= $("<table/>")
					// var $table1 = $("<table cellpadding='0' cellspacing='0' border='0'/>");
					var $tbody1 = $("<tbody/>");
					var $nodeRow1 = $("<tr/>");
					var $nodeCell1 = $("<td class='turunkiri'/>");
					var $nodeCell2 = $("<td class='turunkanan'/>");
					// $nodeCell2.append(imageicon1);
					$nodeRow1.append($nodeCell1).append($nodeCell2);
					$tbody1.append($nodeRow1);
					// $table1.append($tbody1);
					wrapper.append($tbody1);
					
					$downLine.append(wrapper);
				}else{
					$downLine = $("<div></div>").addClass("test");
				}
				$downLineCell.append($downLine);
				$tbody.append($downLineRow);

				// Draw the horizontal lines
				var $linesRow = $("<tr/>");
				$childNodes.each(function () {
					if($c1 != '2'){
						var $left = $("<td>&nbsp;</td>").addClass("line left top");
						var $right = $("<td>&nbsp;</td>").addClass("line right top");
					}else{
						var $left = $("<td>&nbsp;</td>").addClass("hehe");
						var $right = $("<td>&nbsp;</td>").addClass("hehe");
					}
					$linesRow.append($left).append($right);
				});

				// horizontal line shouldn't extend beyond the first and last child branches
				$linesRow.find("td:first")
						.removeClass("top")
						.end()
						.find("td:last")
						.removeClass("top");

				$tbody.append($linesRow);
				var $childNodesRow = $("<tr/>");
				$childNodes.each(function() {
				   var $td = $("<td class='node-container'/>");
				   $td.attr("colspan", 2);
				   // recurse through children lists and items
				   buildNode($(this), $td, level + 1, opts);
				   $childNodesRow.append($td);
				});
			}
			$tbody.append($childNodesRow);
		}

		// any classes on the LI element get copied to the relevant node in the tree
		// apart from the special 'collapsed' class, which collapses the sub-tree at this point
		if ($node.attr('class') != undefined) {
			var classList = $node.attr('class').split(/\s+/);
			$.each(classList, function (index, item) {
				if (item == 'collapsed') {
					$nodeRow.nextAll('tr').css('display', 'none');
					$nodeRow.removeClass('expanded');
					$nodeRow.addClass('contracted');
					$nodeRow.find('img.cover').attr('id', 'gambarplus');
					$nodeRow.find('img.cover').attr('src', 'images/orgchart.plus.png');
				} else {
					$nodeDiv.addClass(item);
				}
			});
		}

		$table.append($tbody);
		$divid.append($table);
		$appendTo.append($divid);

		// node click handler
		$nodeDiv.click(function() {
			opts.nodeClicked.call(this, $(this), 'horizontal');
		});

		/* Prevent trees collapsing if a link inside a node is clicked */
		$nodeDiv.children('a').click(function (e) {
			e.stopPropagation();
		});
	}
	
	// Method that recursively builds the tree (vertical type)
	function buildVerticalTree($node, $appendTo, opts) {		
		if ($node.is("ul")) {
			var $childNodes = $node.children("li");
			var $ul = $("<ul>");
			if ($childNodes.length > 0) {
				$childNodes.each(function () {
					buildVerticalTree($(this), $ul, opts);
				});				
			}			
			
			$appendTo.append($ul);
		}
		else if ($node.is("li")) {
			var $ul = $node.children("ul:first");
			var $li = $node.hasClass('last') ? $("<li>").addClass('last') : $("<li>");
			var $nodeDiv;
			
			// Draw the node
			// Get the contents - any markup except li and ul allowed
			var $nodeContent = $node.clone()
									.children("ul,li")
									.remove()
									.end()
									.html();
			$nodeContent = wrapContent($nodeContent);
			
			//Increments the node count which is used to link the source list and the org chart
			nodeCount++;
			$node.data("tree-node", nodeCount);			
			$nodeDiv = $nodeContent.find('div.content:first');
			$nodeDiv.copyAttributes($node).data("tree-node", nodeCount);
			$li.append($nodeContent);
			
			if ($ul.length > 0) {
				buildVerticalTree($ul, $li, opts);				
			}
			
			$appendTo.append($li);
			
			// node click handler
			$nodeDiv.click(function() {
				opts.nodeClicked.call(this, $(this), 'vertical');
			});
		}
	}
	
	// wrap the contents in a special wrapper
	function wrapContent(content) {
		content = $.trim(content);
		var imageicon1	= $('<div><img class="imageicon" style="height:50px;width:50px; margin-left:10px; margin-right:10px; margin-top:5px" src="images/user.png"/></div>');
		var wrapper = $("<span>");
		var $table1 = $("<table cellpadding='0' cellspacing='0' border='0'/>");
		var $tbody1 = $("<tbody/>");
		var $nodeRow1 = $("<tr/>");
		var $nodeCell1 = $("<td/>");
		var $nodeCell2 = $("<td/>");

		var contentDiv = $("<div style='margin-right:5px; text-align:left'>").addClass("content").append(content);
		$nodeCell1.append(contentDiv);
		// $nodeCell2.append(imageicon1);
		// $nodeRow1.append($nodeCell2).append($nodeCell1);
		// $tbody1.append($nodeRow1);
		// $table1.append($tbody1)
		// wrapper.append($nodeCell1);
		return $nodeCell1;
	}
})(jQuery);