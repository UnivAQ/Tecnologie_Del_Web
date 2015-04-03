<form action="index.php?action=prenota_sosta&parcheggio_id={ $parcheggio_id }&step={ $step }" method="post" name="sostaForm" onSubmit="return sosta_reg();">
<table style="border : 0; width : 100%">
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2"><h2>Prenota una sosta</h2></td>
	</tr>
	<tr>
		<td colspan="2"><p id="errmsg" style="visibility:hidden;display:none;font-size:14px;color:red;"></p></td>
	</tr>
{ if $step == 0 }
	<tr>
		<td><p>Scegli auto:</p></td>
		<td style="text-align : right">
		<select name="auto">
		{ foreach from=$auto_array key=id item=cosa }
			<option value="{ $id }">{ $cosa.marca } { $cosa.nome }: { $cosa.targa }</option>
		{ /foreach }
		</select>
		</td>
	</tr>
	<tr>
		<td><p>Scegli carta di credito:</p></td>
		<td style="text-align : right">
		<select name="carta">
		{ foreach from=$carte_array key=id item=cosa }
			<option value="{ $id }">Carta { $cosa.tipo }: { $cosa.numero }</option>
		{ /foreach }
		</select>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><p>Arrivo (gg/mm/anno hh:mm):</p></td>
		<td style="text-align : right">
		<select name="giorno_a">
			<option value="1"{ if $giorno == 1 } selected = "selected"{ /if }>01</option>
			<option value="2"{ if $giorno == 2 } selected = "selected"{ /if }>02</option>
			<option value="3"{ if $giorno == 3 } selected = "selected"{ /if }>03</option>
			<option value="4"{ if $giorno == 4 } selected = "selected"{ /if }>04</option>
			<option value="5"{ if $giorno == 5 } selected = "selected"{ /if }>05</option>
			<option value="6"{ if $giorno == 6 } selected = "selected"{ /if }>06</option>
			<option value="7"{ if $giorno == 7 } selected = "selected"{ /if }>07</option>
			<option value="8"{ if $giorno == 8 } selected = "selected"{ /if }>08</option>
			<option value="9"{ if $giorno == 9 } selected = "selected"{ /if }>09</option>
			<option value="10"{ if $giorno == 10 } selected = "selected"{ /if }>10</option>
			<option value="11"{ if $giorno == 11 } selected = "selected"{ /if }>11</option>
			<option value="12"{ if $giorno == 12 } selected = "selected"{ /if }>12</option>
			<option value="13"{ if $giorno == 13 } selected = "selected"{ /if }>13</option>
			<option value="14"{ if $giorno == 14 } selected = "selected"{ /if }>14</option>
			<option value="15"{ if $giorno == 15 } selected = "selected"{ /if }>15</option>
			<option value="16"{ if $giorno == 16 } selected = "selected"{ /if }>16</option>
			<option value="17"{ if $giorno == 17 } selected = "selected"{ /if }>17</option>
			<option value="18"{ if $giorno == 18 } selected = "selected"{ /if }>18</option>
			<option value="19"{ if $giorno == 19 } selected = "selected"{ /if }>19</option>
			<option value="20"{ if $giorno == 20 } selected = "selected"{ /if }>20</option>
			<option value="21"{ if $giorno == 21 } selected = "selected"{ /if }>21</option>
			<option value="22"{ if $giorno == 22 } selected = "selected"{ /if }>22</option>
			<option value="23"{ if $giorno == 23 } selected = "selected"{ /if }>23</option>
			<option value="24"{ if $giorno == 24 } selected = "selected"{ /if }>24</option>
			<option value="25"{ if $giorno == 25 } selected = "selected"{ /if }>25</option>
			<option value="26"{ if $giorno == 26 } selected = "selected"{ /if }>26</option>
			<option value="27"{ if $giorno == 27 } selected = "selected"{ /if }>27</option>
			<option value="28"{ if $giorno == 28 } selected = "selected"{ /if }>28</option>
			<option value="29"{ if $giorno == 29 } selected = "selected"{ /if }>29</option>
			<option value="30"{ if $giorno == 30 } selected = "selected"{ /if }>30</option>
			<option value="31"{ if $giorno == 31 } selected = "selected"{ /if }>31</option>
		</select>
		/
		<select name="mese_a">
			<option value="1"{ if $mese == 1 } selected = "selected"{ /if }>01</option>
			<option value="2"{ if $mese == 2 } selected = "selected"{ /if }>02</option>
			<option value="3"{ if $mese == 3 } selected = "selected"{ /if }>03</option>
			<option value="4"{ if $mese == 4 } selected = "selected"{ /if }>04</option>
			<option value="5"{ if $mese == 5 } selected = "selected"{ /if }>05</option>
			<option value="6"{ if $mese == 6 } selected = "selected"{ /if }>06</option>
			<option value="7"{ if $mese == 7 } selected = "selected"{ /if }>07</option>
			<option value="8"{ if $mese == 8 } selected = "selected"{ /if }>08</option>
			<option value="9"{ if $mese == 9 } selected = "selected"{ /if }>09</option>
			<option value="10"{ if $mese == 10 } selected = "selected"{ /if }>10</option>
			<option value="11"{ if $mese == 11 } selected = "selected"{ /if }>11</option>
			<option value="12"{ if $mese == 12 } selected = "selected"{ /if }>12</option>
		</select>
		/
		<select name="anno_a">
			<option value="2008"{ if $anno == 2008 } selected = "selected"{ /if }>2008</option>
			<option value="2007"{ if $anno == 2007 } selected = "selected"{ /if }>2007</option>
			<option value="2006"{ if $anno == 2006 } selected = "selected"{ /if }>2006</option>
			<option value="2005"{ if $anno == 2005 } selected = "selected"{ /if }>2005</option>
			<option value="2004"{ if $anno == 2004 } selected = "selected"{ /if }>2004</option>
			<option value="2003"{ if $anno == 2003 } selected = "selected"{ /if }>2003</option>
			<option value="2002"{ if $anno == 2002 } selected = "selected"{ /if }>2002</option>
			<option value="2001"{ if $anno == 2001 } selected = "selected"{ /if }>2001</option>
			<option value="2000"{ if $anno == 2000 } selected = "selected"{ /if }>2000</option>
			<option value="1999"{ if $anno == 1999 } selected = "selected"{ /if }>1999</option>
			<option value="1998"{ if $anno == 1998 } selected = "selected"{ /if }>1998</option>
			<option value="1997"{ if $anno == 1997 } selected = "selected"{ /if }>1997</option>
			<option value="1996"{ if $anno == 1996 } selected = "selected"{ /if }>1996</option>
			<option value="1995"{ if $anno == 1995 } selected = "selected"{ /if }>1995</option>
			<option value="1994"{ if $anno == 1994 } selected = "selected"{ /if }>1994</option>
			<option value="1993"{ if $anno == 1993 } selected = "selected"{ /if }>1993</option>
			<option value="1992"{ if $anno == 1992 } selected = "selected"{ /if }>1992</option>
			<option value="1991"{ if $anno == 1991 } selected = "selected"{ /if }>1991</option>
			<option value="1990"{ if $anno == 1990 } selected = "selected"{ /if }>1990</option>
			<option value="1989"{ if $anno == 1989 } selected = "selected"{ /if }>1989</option>
			<option value="1988"{ if $anno == 1988 } selected = "selected"{ /if }>1988</option>
			<option value="1987"{ if $anno == 1987 } selected = "selected"{ /if }>1987</option>
			<option value="1986"{ if $anno == 1986 } selected = "selected"{ /if }>1986</option>
			<option value="1985"{ if $anno == 1985 } selected = "selected"{ /if }>1985</option>
			<option value="1984"{ if $anno == 1984 } selected = "selected"{ /if }>1984</option>
			<option value="1983"{ if $anno == 1983 } selected = "selected"{ /if }>1983</option>
			<option value="1982"{ if $anno == 1982 } selected = "selected"{ /if }>1982</option>
			<option value="1981"{ if $anno == 1981 } selected = "selected"{ /if }>1981</option>
			<option value="1980"{ if $anno == 1980 } selected = "selected"{ /if }>1980</option>
			<option value="1979"{ if $anno == 1979 } selected = "selected"{ /if }>1979</option>
			<option value="1978"{ if $anno == 1978 } selected = "selected"{ /if }>1978</option>
			<option value="1977"{ if $anno == 1977 } selected = "selected"{ /if }>1977</option>
			<option value="1976"{ if $anno == 1976 } selected = "selected"{ /if }>1976</option>
			<option value="1975"{ if $anno == 1975 } selected = "selected"{ /if }>1975</option>
			<option value="1974"{ if $anno == 1974 } selected = "selected"{ /if }>1974</option>
			<option value="1973"{ if $anno == 1973 } selected = "selected"{ /if }>1973</option>
			<option value="1972"{ if $anno == 1972 } selected = "selected"{ /if }>1972</option>
			<option value="1971"{ if $anno == 1971 } selected = "selected"{ /if }>1971</option>
			<option value="1970"{ if $anno == 1970 } selected = "selected"{ /if }>1970</option>
			<option value="1969"{ if $anno == 1969 } selected = "selected"{ /if }>1969</option>
			<option value="1968"{ if $anno == 1968 } selected = "selected"{ /if }>1968</option>
			<option value="1967"{ if $anno == 1967 } selected = "selected"{ /if }>1967</option>
			<option value="1966"{ if $anno == 1966 } selected = "selected"{ /if }>1966</option>
			<option value="1965"{ if $anno == 1965 } selected = "selected"{ /if }>1965</option>
			<option value="1964"{ if $anno == 1964 } selected = "selected"{ /if }>1964</option>
			<option value="1963"{ if $anno == 1963 } selected = "selected"{ /if }>1963</option>
			<option value="1962"{ if $anno == 1962 } selected = "selected"{ /if }>1962</option>
			<option value="1961"{ if $anno == 1961 } selected = "selected"{ /if }>1961</option>
			<option value="1960"{ if $anno == 1960 } selected = "selected"{ /if }>1960</option>
			<option value="1959"{ if $anno == 1959 } selected = "selected"{ /if }>1959</option>
			<option value="1958"{ if $anno == 1958 } selected = "selected"{ /if }>1958</option>
			<option value="1957"{ if $anno == 1957 } selected = "selected"{ /if }>1957</option>
			<option value="1956"{ if $anno == 1956 } selected = "selected"{ /if }>1956</option>
			<option value="1955"{ if $anno == 1955 } selected = "selected"{ /if }>1955</option>
			<option value="1954"{ if $anno == 1954 } selected = "selected"{ /if }>1954</option>
			<option value="1953"{ if $anno == 1953 } selected = "selected"{ /if }>1953</option>
			<option value="1952"{ if $anno == 1952 } selected = "selected"{ /if }>1952</option>
			<option value="1951"{ if $anno == 1951 } selected = "selected"{ /if }>1951</option>
			<option value="1950"{ if $anno == 1950 } selected = "selected"{ /if }>1950</option>
			<option value="1949"{ if $anno == 1949 } selected = "selected"{ /if }>1949</option>
			<option value="1948"{ if $anno == 1948 } selected = "selected"{ /if }>1948</option>
			<option value="1947"{ if $anno == 1947 } selected = "selected"{ /if }>1947</option>
			<option value="1946"{ if $anno == 1946 } selected = "selected"{ /if }>1946</option>
			<option value="1945"{ if $anno == 1945 } selected = "selected"{ /if }>1945</option>
			<option value="1944"{ if $anno == 1944 } selected = "selected"{ /if }>1944</option>
			<option value="1943"{ if $anno == 1943 } selected = "selected"{ /if }>1943</option>
			<option value="1942"{ if $anno == 1942 } selected = "selected"{ /if }>1942</option>
			<option value="1941"{ if $anno == 1941 } selected = "selected"{ /if }>1941</option>
			<option value="1940"{ if $anno == 1940 } selected = "selected"{ /if }>1940</option>
			<option value="1939"{ if $anno == 1939 } selected = "selected"{ /if }>1939</option>
			<option value="1938"{ if $anno == 1938 } selected = "selected"{ /if }>1938</option>
			<option value="1937"{ if $anno == 1937 } selected = "selected"{ /if }>1937</option>
			<option value="1936"{ if $anno == 1936 } selected = "selected"{ /if }>1936</option>
			<option value="1935"{ if $anno == 1935 } selected = "selected"{ /if }>1935</option>
			<option value="1934"{ if $anno == 1934 } selected = "selected"{ /if }>1934</option>
			<option value="1933"{ if $anno == 1933 } selected = "selected"{ /if }>1933</option>
			<option value="1932"{ if $anno == 1932 } selected = "selected"{ /if }>1932</option>
			<option value="1931"{ if $anno == 1931 } selected = "selected"{ /if }>1931</option>
			<option value="1930"{ if $anno == 1930 } selected = "selected"{ /if }>1930</option>
			<option value="1929"{ if $anno == 1929 } selected = "selected"{ /if }>1929</option>
			<option value="1928"{ if $anno == 1928 } selected = "selected"{ /if }>1928</option>
			<option value="1927"{ if $anno == 1927 } selected = "selected"{ /if }>1927</option>
			<option value="1926"{ if $anno == 1926 } selected = "selected"{ /if }>1926</option>
			<option value="1925"{ if $anno == 1925 } selected = "selected"{ /if }>1925</option>
			<option value="1924"{ if $anno == 1924 } selected = "selected"{ /if }>1924</option>
			<option value="1923"{ if $anno == 1923 } selected = "selected"{ /if }>1923</option>
			<option value="1922"{ if $anno == 1922 } selected = "selected"{ /if }>1922</option>
			<option value="1921"{ if $anno == 1921 } selected = "selected"{ /if }>1921</option>
			<option value="1920"{ if $anno == 1920 } selected = "selected"{ /if }>1920</option>
			<option value="1919"{ if $anno == 1919 } selected = "selected"{ /if }>1919</option>
			<option value="1918"{ if $anno == 1918 } selected = "selected"{ /if }>1918</option>
			<option value="1917"{ if $anno == 1917 } selected = "selected"{ /if }>1917</option>
			<option value="1916"{ if $anno == 1916 } selected = "selected"{ /if }>1916</option>
			<option value="1915"{ if $anno == 1915 } selected = "selected"{ /if }>1915</option>
			<option value="1914"{ if $anno == 1914 } selected = "selected"{ /if }>1914</option>
			<option value="1913"{ if $anno == 1913 } selected = "selected"{ /if }>1913</option>
			<option value="1912"{ if $anno == 1912 } selected = "selected"{ /if }>1912</option>
			<option value="1911"{ if $anno == 1911 } selected = "selected"{ /if }>1911</option>
			<option value="1910"{ if $anno == 1910 } selected = "selected"{ /if }>1910</option>
			<option value="1909"{ if $anno == 1909 } selected = "selected"{ /if }>1909</option>
			<option value="1908"{ if $anno == 1908 } selected = "selected"{ /if }>1908</option>
			<option value="1907"{ if $anno == 1907 } selected = "selected"{ /if }>1907</option>
			<option value="1906"{ if $anno == 1906 } selected = "selected"{ /if }>1906</option>
			<option value="1905"{ if $anno == 1905 } selected = "selected"{ /if }>1905</option>
			<option value="1904"{ if $anno == 1904 } selected = "selected"{ /if }>1904</option>
			<option value="1903"{ if $anno == 1903 } selected = "selected"{ /if }>1903</option>
			<option value="1902"{ if $anno == 1902 } selected = "selected"{ /if }>1902</option>
			<option value="1901"{ if $anno == 1901 } selected = "selected"{ /if }>1901</option>
			<option value="1900"{ if $anno == 1900 } selected = "selected"{ /if }>1900</option>
		</select>
		&nbsp;
		<select name="ora_a">
			<option value="0"{ if $ora == 0 } selected = "selected"{ /if }>00:00</option>
			<option value="1"{ if $ora == 1 } selected = "selected"{ /if }>01:00</option>
			<option value="2"{ if $ora == 2 } selected = "selected"{ /if }>02:00</option>
			<option value="3"{ if $ora == 3 } selected = "selected"{ /if }>03:00</option>
			<option value="4"{ if $ora == 4 } selected = "selected"{ /if }>04:00</option>
			<option value="5"{ if $ora == 5 } selected = "selected"{ /if }>05:00</option>
			<option value="6"{ if $ora == 6 } selected = "selected"{ /if }>06:00</option>
			<option value="7"{ if $ora == 7 } selected = "selected"{ /if }>07:00</option>
			<option value="8"{ if $ora == 8 } selected = "selected"{ /if }>08:00</option>
			<option value="9"{ if $ora == 9 } selected = "selected"{ /if }>09:00</option>
			<option value="10"{ if $ora == 10 } selected = "selected"{ /if }>10:00</option>
			<option value="11"{ if $ora == 11 } selected = "selected"{ /if }>11:00</option>
			<option value="12"{ if $ora == 12 } selected = "selected"{ /if }>12:00</option>
			<option value="13"{ if $ora == 13 } selected = "selected"{ /if }>13:00</option>
			<option value="14"{ if $ora == 14 } selected = "selected"{ /if }>14:00</option>
			<option value="15"{ if $ora == 15 } selected = "selected"{ /if }>15:00</option>
			<option value="16"{ if $ora == 16 } selected = "selected"{ /if }>16:00</option>
			<option value="17"{ if $ora == 17 } selected = "selected"{ /if }>17:00</option>
			<option value="18"{ if $ora == 18 } selected = "selected"{ /if }>18:00</option>
			<option value="19"{ if $ora == 19 } selected = "selected"{ /if }>19:00</option>
			<option value="20"{ if $ora == 20 } selected = "selected"{ /if }>20:00</option>
			<option value="21"{ if $ora == 21 } selected = "selected"{ /if }>21:00</option>
			<option value="22"{ if $ora == 22 } selected = "selected"{ /if }>22:00</option>
			<option value="23"{ if $ora == 23 } selected = "selected"{ /if }>23:00</option>
			<option value="24"{ if $ora == 24 } selected = "selected"{ /if }>24:00</option>
		</select>
		</td>
	</tr>
	<tr>
		<td><p>Partenza (gg/mm/anno hh:mm):</p></td>
		<td style="text-align : right">
		<select name="giorno_p">
			<option value="1"{ if $giorno == 1 } selected = "selected"{ /if }>01</option>
			<option value="2"{ if $giorno == 2 } selected = "selected"{ /if }>02</option>
			<option value="3"{ if $giorno == 3 } selected = "selected"{ /if }>03</option>
			<option value="4"{ if $giorno == 4 } selected = "selected"{ /if }>04</option>
			<option value="5"{ if $giorno == 5 } selected = "selected"{ /if }>05</option>
			<option value="6"{ if $giorno == 6 } selected = "selected"{ /if }>06</option>
			<option value="7"{ if $giorno == 7 } selected = "selected"{ /if }>07</option>
			<option value="8"{ if $giorno == 8 } selected = "selected"{ /if }>08</option>
			<option value="9"{ if $giorno == 9 } selected = "selected"{ /if }>09</option>
			<option value="10"{ if $giorno == 10 } selected = "selected"{ /if }>10</option>
			<option value="11"{ if $giorno == 11 } selected = "selected"{ /if }>11</option>
			<option value="12"{ if $giorno == 12 } selected = "selected"{ /if }>12</option>
			<option value="13"{ if $giorno == 13 } selected = "selected"{ /if }>13</option>
			<option value="14"{ if $giorno == 14 } selected = "selected"{ /if }>14</option>
			<option value="15"{ if $giorno == 15 } selected = "selected"{ /if }>15</option>
			<option value="16"{ if $giorno == 16 } selected = "selected"{ /if }>16</option>
			<option value="17"{ if $giorno == 17 } selected = "selected"{ /if }>17</option>
			<option value="18"{ if $giorno == 18 } selected = "selected"{ /if }>18</option>
			<option value="19"{ if $giorno == 19 } selected = "selected"{ /if }>19</option>
			<option value="20"{ if $giorno == 20 } selected = "selected"{ /if }>20</option>
			<option value="21"{ if $giorno == 21 } selected = "selected"{ /if }>21</option>
			<option value="22"{ if $giorno == 22 } selected = "selected"{ /if }>22</option>
			<option value="23"{ if $giorno == 23 } selected = "selected"{ /if }>23</option>
			<option value="24"{ if $giorno == 24 } selected = "selected"{ /if }>24</option>
			<option value="25"{ if $giorno == 25 } selected = "selected"{ /if }>25</option>
			<option value="26"{ if $giorno == 26 } selected = "selected"{ /if }>26</option>
			<option value="27"{ if $giorno == 27 } selected = "selected"{ /if }>27</option>
			<option value="28"{ if $giorno == 28 } selected = "selected"{ /if }>28</option>
			<option value="29"{ if $giorno == 29 } selected = "selected"{ /if }>29</option>
			<option value="30"{ if $giorno == 30 } selected = "selected"{ /if }>30</option>
			<option value="31"{ if $giorno == 31 } selected = "selected"{ /if }>31</option>
		</select>
		/
		<select name="mese_p">
			<option value="1"{ if $mese == 1 } selected = "selected"{ /if }>01</option>
			<option value="2"{ if $mese == 2 } selected = "selected"{ /if }>02</option>
			<option value="3"{ if $mese == 3 } selected = "selected"{ /if }>03</option>
			<option value="4"{ if $mese == 4 } selected = "selected"{ /if }>04</option>
			<option value="5"{ if $mese == 5 } selected = "selected"{ /if }>05</option>
			<option value="6"{ if $mese == 6 } selected = "selected"{ /if }>06</option>
			<option value="7"{ if $mese == 7 } selected = "selected"{ /if }>07</option>
			<option value="8"{ if $mese == 8 } selected = "selected"{ /if }>08</option>
			<option value="9"{ if $mese == 9 } selected = "selected"{ /if }>09</option>
			<option value="10"{ if $mese == 10 } selected = "selected"{ /if }>10</option>
			<option value="11"{ if $mese == 11 } selected = "selected"{ /if }>11</option>
			<option value="12"{ if $mese == 12 } selected = "selected"{ /if }>12</option>
		</select>
		/
		<select name="anno_p">
			<option value="2008"{ if $anno == 2008 } selected = "selected"{ /if }>2008</option>
			<option value="2007"{ if $anno == 2007 } selected = "selected"{ /if }>2007</option>
			<option value="2006"{ if $anno == 2006 } selected = "selected"{ /if }>2006</option>
			<option value="2005"{ if $anno == 2005 } selected = "selected"{ /if }>2005</option>
			<option value="2004"{ if $anno == 2004 } selected = "selected"{ /if }>2004</option>
			<option value="2003"{ if $anno == 2003 } selected = "selected"{ /if }>2003</option>
			<option value="2002"{ if $anno == 2002 } selected = "selected"{ /if }>2002</option>
			<option value="2001"{ if $anno == 2001 } selected = "selected"{ /if }>2001</option>
			<option value="2000"{ if $anno == 2000 } selected = "selected"{ /if }>2000</option>
			<option value="1999"{ if $anno == 1999 } selected = "selected"{ /if }>1999</option>
			<option value="1998"{ if $anno == 1998 } selected = "selected"{ /if }>1998</option>
			<option value="1997"{ if $anno == 1997 } selected = "selected"{ /if }>1997</option>
			<option value="1996"{ if $anno == 1996 } selected = "selected"{ /if }>1996</option>
			<option value="1995"{ if $anno == 1995 } selected = "selected"{ /if }>1995</option>
			<option value="1994"{ if $anno == 1994 } selected = "selected"{ /if }>1994</option>
			<option value="1993"{ if $anno == 1993 } selected = "selected"{ /if }>1993</option>
			<option value="1992"{ if $anno == 1992 } selected = "selected"{ /if }>1992</option>
			<option value="1991"{ if $anno == 1991 } selected = "selected"{ /if }>1991</option>
			<option value="1990"{ if $anno == 1990 } selected = "selected"{ /if }>1990</option>
			<option value="1989"{ if $anno == 1989 } selected = "selected"{ /if }>1989</option>
			<option value="1988"{ if $anno == 1988 } selected = "selected"{ /if }>1988</option>
			<option value="1987"{ if $anno == 1987 } selected = "selected"{ /if }>1987</option>
			<option value="1986"{ if $anno == 1986 } selected = "selected"{ /if }>1986</option>
			<option value="1985"{ if $anno == 1985 } selected = "selected"{ /if }>1985</option>
			<option value="1984"{ if $anno == 1984 } selected = "selected"{ /if }>1984</option>
			<option value="1983"{ if $anno == 1983 } selected = "selected"{ /if }>1983</option>
			<option value="1982"{ if $anno == 1982 } selected = "selected"{ /if }>1982</option>
			<option value="1981"{ if $anno == 1981 } selected = "selected"{ /if }>1981</option>
			<option value="1980"{ if $anno == 1980 } selected = "selected"{ /if }>1980</option>
			<option value="1979"{ if $anno == 1979 } selected = "selected"{ /if }>1979</option>
			<option value="1978"{ if $anno == 1978 } selected = "selected"{ /if }>1978</option>
			<option value="1977"{ if $anno == 1977 } selected = "selected"{ /if }>1977</option>
			<option value="1976"{ if $anno == 1976 } selected = "selected"{ /if }>1976</option>
			<option value="1975"{ if $anno == 1975 } selected = "selected"{ /if }>1975</option>
			<option value="1974"{ if $anno == 1974 } selected = "selected"{ /if }>1974</option>
			<option value="1973"{ if $anno == 1973 } selected = "selected"{ /if }>1973</option>
			<option value="1972"{ if $anno == 1972 } selected = "selected"{ /if }>1972</option>
			<option value="1971"{ if $anno == 1971 } selected = "selected"{ /if }>1971</option>
			<option value="1970"{ if $anno == 1970 } selected = "selected"{ /if }>1970</option>
			<option value="1969"{ if $anno == 1969 } selected = "selected"{ /if }>1969</option>
			<option value="1968"{ if $anno == 1968 } selected = "selected"{ /if }>1968</option>
			<option value="1967"{ if $anno == 1967 } selected = "selected"{ /if }>1967</option>
			<option value="1966"{ if $anno == 1966 } selected = "selected"{ /if }>1966</option>
			<option value="1965"{ if $anno == 1965 } selected = "selected"{ /if }>1965</option>
			<option value="1964"{ if $anno == 1964 } selected = "selected"{ /if }>1964</option>
			<option value="1963"{ if $anno == 1963 } selected = "selected"{ /if }>1963</option>
			<option value="1962"{ if $anno == 1962 } selected = "selected"{ /if }>1962</option>
			<option value="1961"{ if $anno == 1961 } selected = "selected"{ /if }>1961</option>
			<option value="1960"{ if $anno == 1960 } selected = "selected"{ /if }>1960</option>
			<option value="1959"{ if $anno == 1959 } selected = "selected"{ /if }>1959</option>
			<option value="1958"{ if $anno == 1958 } selected = "selected"{ /if }>1958</option>
			<option value="1957"{ if $anno == 1957 } selected = "selected"{ /if }>1957</option>
			<option value="1956"{ if $anno == 1956 } selected = "selected"{ /if }>1956</option>
			<option value="1955"{ if $anno == 1955 } selected = "selected"{ /if }>1955</option>
			<option value="1954"{ if $anno == 1954 } selected = "selected"{ /if }>1954</option>
			<option value="1953"{ if $anno == 1953 } selected = "selected"{ /if }>1953</option>
			<option value="1952"{ if $anno == 1952 } selected = "selected"{ /if }>1952</option>
			<option value="1951"{ if $anno == 1951 } selected = "selected"{ /if }>1951</option>
			<option value="1950"{ if $anno == 1950 } selected = "selected"{ /if }>1950</option>
			<option value="1949"{ if $anno == 1949 } selected = "selected"{ /if }>1949</option>
			<option value="1948"{ if $anno == 1948 } selected = "selected"{ /if }>1948</option>
			<option value="1947"{ if $anno == 1947 } selected = "selected"{ /if }>1947</option>
			<option value="1946"{ if $anno == 1946 } selected = "selected"{ /if }>1946</option>
			<option value="1945"{ if $anno == 1945 } selected = "selected"{ /if }>1945</option>
			<option value="1944"{ if $anno == 1944 } selected = "selected"{ /if }>1944</option>
			<option value="1943"{ if $anno == 1943 } selected = "selected"{ /if }>1943</option>
			<option value="1942"{ if $anno == 1942 } selected = "selected"{ /if }>1942</option>
			<option value="1941"{ if $anno == 1941 } selected = "selected"{ /if }>1941</option>
			<option value="1940"{ if $anno == 1940 } selected = "selected"{ /if }>1940</option>
			<option value="1939"{ if $anno == 1939 } selected = "selected"{ /if }>1939</option>
			<option value="1938"{ if $anno == 1938 } selected = "selected"{ /if }>1938</option>
			<option value="1937"{ if $anno == 1937 } selected = "selected"{ /if }>1937</option>
			<option value="1936"{ if $anno == 1936 } selected = "selected"{ /if }>1936</option>
			<option value="1935"{ if $anno == 1935 } selected = "selected"{ /if }>1935</option>
			<option value="1934"{ if $anno == 1934 } selected = "selected"{ /if }>1934</option>
			<option value="1933"{ if $anno == 1933 } selected = "selected"{ /if }>1933</option>
			<option value="1932"{ if $anno == 1932 } selected = "selected"{ /if }>1932</option>
			<option value="1931"{ if $anno == 1931 } selected = "selected"{ /if }>1931</option>
			<option value="1930"{ if $anno == 1930 } selected = "selected"{ /if }>1930</option>
			<option value="1929"{ if $anno == 1929 } selected = "selected"{ /if }>1929</option>
			<option value="1928"{ if $anno == 1928 } selected = "selected"{ /if }>1928</option>
			<option value="1927"{ if $anno == 1927 } selected = "selected"{ /if }>1927</option>
			<option value="1926"{ if $anno == 1926 } selected = "selected"{ /if }>1926</option>
			<option value="1925"{ if $anno == 1925 } selected = "selected"{ /if }>1925</option>
			<option value="1924"{ if $anno == 1924 } selected = "selected"{ /if }>1924</option>
			<option value="1923"{ if $anno == 1923 } selected = "selected"{ /if }>1923</option>
			<option value="1922"{ if $anno == 1922 } selected = "selected"{ /if }>1922</option>
			<option value="1921"{ if $anno == 1921 } selected = "selected"{ /if }>1921</option>
			<option value="1920"{ if $anno == 1920 } selected = "selected"{ /if }>1920</option>
			<option value="1919"{ if $anno == 1919 } selected = "selected"{ /if }>1919</option>
			<option value="1918"{ if $anno == 1918 } selected = "selected"{ /if }>1918</option>
			<option value="1917"{ if $anno == 1917 } selected = "selected"{ /if }>1917</option>
			<option value="1916"{ if $anno == 1916 } selected = "selected"{ /if }>1916</option>
			<option value="1915"{ if $anno == 1915 } selected = "selected"{ /if }>1915</option>
			<option value="1914"{ if $anno == 1914 } selected = "selected"{ /if }>1914</option>
			<option value="1913"{ if $anno == 1913 } selected = "selected"{ /if }>1913</option>
			<option value="1912"{ if $anno == 1912 } selected = "selected"{ /if }>1912</option>
			<option value="1911"{ if $anno == 1911 } selected = "selected"{ /if }>1911</option>
			<option value="1910"{ if $anno == 1910 } selected = "selected"{ /if }>1910</option>
			<option value="1909"{ if $anno == 1909 } selected = "selected"{ /if }>1909</option>
			<option value="1908"{ if $anno == 1908 } selected = "selected"{ /if }>1908</option>
			<option value="1907"{ if $anno == 1907 } selected = "selected"{ /if }>1907</option>
			<option value="1906"{ if $anno == 1906 } selected = "selected"{ /if }>1906</option>
			<option value="1905"{ if $anno == 1905 } selected = "selected"{ /if }>1905</option>
			<option value="1904"{ if $anno == 1904 } selected = "selected"{ /if }>1904</option>
			<option value="1903"{ if $anno == 1903 } selected = "selected"{ /if }>1903</option>
			<option value="1902"{ if $anno == 1902 } selected = "selected"{ /if }>1902</option>
			<option value="1901"{ if $anno == 1901 } selected = "selected"{ /if }>1901</option>
			<option value="1900"{ if $anno == 1900 } selected = "selected"{ /if }>1900</option>
		</select>
		&nbsp;
		<select name="ora_p">
			<option value="0"{ if $ora == 0 } selected = "selected"{ /if }>00:00</option>
			<option value="1"{ if $ora == 1 } selected = "selected"{ /if }>01:00</option>
			<option value="2"{ if $ora == 2 } selected = "selected"{ /if }>02:00</option>
			<option value="3"{ if $ora == 3 } selected = "selected"{ /if }>03:00</option>
			<option value="4"{ if $ora == 4 } selected = "selected"{ /if }>04:00</option>
			<option value="5"{ if $ora == 5 } selected = "selected"{ /if }>05:00</option>
			<option value="6"{ if $ora == 6 } selected = "selected"{ /if }>06:00</option>
			<option value="7"{ if $ora == 7 } selected = "selected"{ /if }>07:00</option>
			<option value="8"{ if $ora == 8 } selected = "selected"{ /if }>08:00</option>
			<option value="9"{ if $ora == 9 } selected = "selected"{ /if }>09:00</option>
			<option value="10"{ if $ora == 10 } selected = "selected"{ /if }>10:00</option>
			<option value="11"{ if $ora == 11 } selected = "selected"{ /if }>11:00</option>
			<option value="12"{ if $ora == 12 } selected = "selected"{ /if }>12:00</option>
			<option value="13"{ if $ora == 13 } selected = "selected"{ /if }>13:00</option>
			<option value="14"{ if $ora == 14 } selected = "selected"{ /if }>14:00</option>
			<option value="15"{ if $ora == 15 } selected = "selected"{ /if }>15:00</option>
			<option value="16"{ if $ora == 16 } selected = "selected"{ /if }>16:00</option>
			<option value="17"{ if $ora == 17 } selected = "selected"{ /if }>17:00</option>
			<option value="18"{ if $ora == 18 } selected = "selected"{ /if }>18:00</option>
			<option value="19"{ if $ora == 19 } selected = "selected"{ /if }>19:00</option>
			<option value="20"{ if $ora == 20 } selected = "selected"{ /if }>20:00</option>
			<option value="21"{ if $ora == 21 } selected = "selected"{ /if }>21:00</option>
			<option value="22"{ if $ora == 22 } selected = "selected"{ /if }>22:00</option>
			<option value="23"{ if $ora == 23 } selected = "selected"{ /if }>23:00</option>
			<option value="24"{ if $ora == 24 } selected = "selected"{ /if }>24:00</option>
		</select>
		</td>
	</tr>
{ elseif $step == 1 }
	
{ /if }
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td style="text-align : right" colspan="2"><input type="submit" value="Invia" size="5" onclick="return conferma();"/></td>
	</tr>
</table>
</form>