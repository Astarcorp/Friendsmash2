<?php

	class yahoo_equities
	{
  
    	function get_equities($equity, $cache)
    	{
  			return $this->generate_equity_array($equity);   
    	} 
     
  		function generate_equity_array($equity) //Create array
  		{
			echo "<table border=1 cellspacing=3.5 cellpadding=2.5 >";
						
			$row = 1;
			if (($handle = fopen($equity, "r")) !== FALSE) 
			{
    			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
    			{
        			$num = count($data); //Counting of data
					echo "<tr>";
        			$row++;
       				for ($c=0; $c < $num; $c++) //Getting data
        			{
						if ($row%2==0)
						{
							echo "<td class=even>"; //Even rows
							if ($data[5]<0&&($c==5||$c==2||$c==1)) //Finding negative equities' changes, last trade & name
								echo "<font color=red>";
							else	
							{
								if ($data[5]>0&&($c==5||$c==2||$c==1)) //Finding positive equities' changes, last trade & name
								echo "<font color=green>";
							}
							echo $data[$c]."</font>"; //Colouring of positive/negative equities changes, last trade & name
							if (($c+1)==$num)//Printing of charts
							{
								echo "</td><td class=even><img src=http://ichart.finance.yahoo.com/h?s=".$data[1]."&lang=en-SG&region=sg></td>";
							}
							else 
								echo "</td>";
						}
						else
						{
							echo "<td class=odd>"; //Odd rows
							if ($data[5]<0&&($c==5||$c==2||$c==1)) //Finding negative equities' changes, last trade & name
								echo "<font color=red>";
							else
							{
								if ($data[5]>0&&($c==5||$c==2||$c==1)) //Finding positive equities' changes, last trade & name
								echo "<font color=green>";
							}
							echo $data[$c]."</font>"; //Colouring of positive/negative equities changes, last trade & name
							if (($c+1)==$num)//Printing of charts
							{
								echo "</td><td class=odd><img src=http://ichart.finance.yahoo.com/h?s=".$data[1]."&lang=en-SG&region=sg></td>";
							}
							else 
								echo "</td>";
						}
        			} 
   	 			} echo "</tr>";
		  		echo "</table>";
    	  		fclose($handle);
			}
  		} 
 
  }  
  
  $equities = new yahoo_equities();
  
  $equities->get_equities("http://download.finance.yahoo.com/d/quotes.csv?s=A33.SI+5DN.SI+E5H.SI+557.SI+N21.SI+5WH.SI+MT1.SI+A78.SI+Z74.SI+5MM.SI+545.SI+G13.SI+C31.SI+5GB.SI+S21.SI+BS6.SI+5ET.SI+MC0.SI+JS8.SI+5ME.SI&f=nsl1opc6b2b3vmwep6rd1t1", "n"); //Get equities

?>  