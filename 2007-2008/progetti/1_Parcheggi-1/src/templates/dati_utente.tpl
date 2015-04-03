<p id="errmsg" style="visibility:hidden;display:none;font-size:14px;color:red;"></p>
{ if $modifica_utente }
	<form name="regUserForm" action="index.php?action=modifica_utente&id={ $mod_id }" method="post" onSubmit="return mod_user();">
{ elseif $aggiungi_utente }
	<form name="regUserForm" action="index.php?action=aggiungi_utente" method="post" onSubmit="return reg_user();">
{ /if }
	<table style="border : 0; width : 100%">
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><b>Anagrafica</b></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Nome</td>
		<td style="text-align : right"><input type="text" name="nome" value="{$nome}" size="25" maxlength="100" /></td>
	</tr>
	<tr>
		<td>Cognome</td>
		<td style="text-align : right"><input type="text" name="cognome" value="{$cognome}" size="25" maxlength="100" /></td>
	</tr>
	<tr>
		<td>Luogo di nascita</td>
		<td style="text-align : right"><input type="text" name="l_nascita" value="{$l_nascita}" size="25" maxlength="100" /></td>
	</tr>
	<tr>
		<td>Data di nascita</td>
		<td style="text-align : right"><select name="g_nascita">
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
		<select name="m_nascita">
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
		<select name="a_nascita">
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
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><b>Account</b></td>
		<td>&nbsp;</td>
	</tr>
	{ if $aggiungi_utente }
	<tr>
		<td>Username (max 25 car.)</td>
		<td style="text-align : right"><input type="text" name="username" value="" size="25" maxlength="100" /></td>
	</tr>
	{ /if }
	<tr>
		<td>Password (max 25 car.)</td>
		<td style="text-align : right"><input type="password" name="password" value="" size="25" maxlength="25" /></td>
	</tr>
	<tr>
		<td>Ripeti password</td>
		<td style="text-align : right"><input type="password" name="password2" value="" size="25" maxlength="25" /></td>
	</tr>
	<tr>
		<td>Email</td>
		<td style="text-align : right"><input type="text" name="email" value="{$email}" size="25" maxlength="100" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><b>Residenza</b></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Via</td>
		<td style="text-align : right"><input type="text" name="via" value="{$via}" size="25" maxlength="100" /></td>
	</tr>
	<tr>
		<td>Numero civico</td>
		<td style="text-align : right"><input type="text" name="civico" value="{$civico}" size="10" maxlength="10" /></td>
	</tr>
	<tr>
		<td>Comune</td>
		<td style="text-align : right"><input type="text" name="comune" value="{$comune}" size="25" maxlength="100" /></td>
	</tr>
	<tr>
		<td>Provincia</td>
		<td style="text-align : right"><select name="provincia">
											<option value=""></option>
											<option value="AG" { if $provincia == "AG" } selected = "selected"{ /if }>AGRIGENTO</option>
											<option value="AL" { if $provincia == "AL" } selected = "selected"{ /if }>ALESSANDRIA</option>
											<option value="AN" { if $provincia == "AN" } selected = "selected"{ /if }>ANCONA</option>
											<option value="AO" { if $provincia == "AO" } selected = "selected"{ /if }>AOSTA</option>
											<option value="AR" { if $provincia == "AR" } selected = "selected"{ /if }>AREZZO</option>
											<option value="AP" { if $provincia == "AP" } selected = "selected"{ /if }>ASCOLI PICENO</option>
											<option value="AT" { if $provincia == "AT" } selected = "selected"{ /if }>ASTI</option>
											<option value="AV" { if $provincia == "AV" } selected = "selected"{ /if }>AVELLINO</option>
											<option value="BA" { if $provincia == "BA" } selected = "selected"{ /if }>BARI</option>
											<option value="BL" { if $provincia == "BL" } selected = "selected"{ /if }>BELLUNO</option>
											<option value="BN" { if $provincia == "BN" } selected = "selected"{ /if }>BENEVENTO</option>
											<option value="BG" { if $provincia == "BG" } selected = "selected"{ /if }>BERGAMO</option>
											<option value="BI" { if $provincia == "BI" } selected = "selected"{ /if }>BIELLA</option>
											<option value="BO" { if $provincia == "BO" } selected = "selected"{ /if }>BOLOGNA</option>
											<option value="BZ" { if $provincia == "BZ" } selected = "selected"{ /if }>BOLZANO</option>
											<option value="BS" { if $provincia == "BS" } selected = "selected"{ /if }>BRESCIA</option>
											<option value="BR" { if $provincia == "BR" } selected = "selected"{ /if }>BRINDISI</option>
											<option value="CA" { if $provincia == "CA" } selected = "selected"{ /if }>CAGLIARI</option>
											<option value="CL" { if $provincia == "CL" } selected = "selected"{ /if }>CALTANISSETTA</option>
											<option value="CB" { if $provincia == "CB" } selected = "selected"{ /if }>CAMPOBASSO</option>
											<option value="CE" { if $provincia == "CE" } selected = "selected"{ /if }>CASERTA</option>
											<option value="CT" { if $provincia == "CT" } selected = "selected"{ /if }>CATANIA</option>
											<option value="CZ" { if $provincia == "CZ" } selected = "selected"{ /if }>CATANZARO</option>
											<option value="CH" { if $provincia == "CH" } selected = "selected"{ /if }>CHIETI</option>
											<option value="CO" { if $provincia == "CO" } selected = "selected"{ /if }>COMO</option>
											<option value="CS" { if $provincia == "CS" } selected = "selected"{ /if }>COSENZA</option>
											<option value="CR" { if $provincia == "CR" } selected = "selected"{ /if }>CREMONA</option>
											<option value="KR" { if $provincia == "KR" } selected = "selected"{ /if }>CROTONE</option>
											<option value="CN" { if $provincia == "CN" } selected = "selected"{ /if }>CUNEO</option>
											<option value="EN" { if $provincia == "EN" } selected = "selected"{ /if }>ENNA</option>
											<option value="FE" { if $provincia == "FE" } selected = "selected"{ /if }>FERRARA</option>
											<option value="FI" { if $provincia == "FI" } selected = "selected"{ /if }>FIRENZE</option>
											<option value="FG" { if $provincia == "FG" } selected = "selected"{ /if }>FOGGIA</option>
											<option value="FC" { if $provincia == "FC" } selected = "selected"{ /if }>FORLI'-CESENA</option>
											<option value="FR" { if $provincia == "FR" } selected = "selected"{ /if }>FROSINONE</option>
											<option value="GE" { if $provincia == "GE" } selected = "selected"{ /if }>GENOVA</option>
											<option value="GO" { if $provincia == "GO" } selected = "selected"{ /if }>GORIZIA</option>
											<option value="GR" { if $provincia == "GR" } selected = "selected"{ /if }>GROSSETO</option>
											<option value="IM" { if $provincia == "IM" } selected = "selected"{ /if }>IMPERIA</option>
											<option value="IS" { if $provincia == "IS" } selected = "selected"{ /if }>ISERNIA</option>
											<option value="SP" { if $provincia == "SP" } selected = "selected"{ /if }>LA SPEZIA</option>
											<option value="AQ" { if $provincia == "AQ" } selected = "selected"{ /if }>L'AQUILA</option>
											<option value="LT" { if $provincia == "LT" } selected = "selected"{ /if }>LATINA</option>
											<option value="LE" { if $provincia == "LE" } selected = "selected"{ /if }>LECCE</option>
											<option value="LC" { if $provincia == "LC" } selected = "selected"{ /if }>LECCO</option>
											<option value="LI" { if $provincia == "LI" } selected = "selected"{ /if }>LIVORNO</option>
											<option value="LO" { if $provincia == "LO" } selected = "selected"{ /if }>LODI</option>
											<option value="LU" { if $provincia == "LU" } selected = "selected"{ /if }>LUCCA</option>
											<option value="MC" { if $provincia == "MC" } selected = "selected"{ /if }>MACERATA</option>
											<option value="MN" { if $provincia == "MN" } selected = "selected"{ /if }>MANTOVA</option>
											<option value="MS" { if $provincia == "MS" } selected = "selected"{ /if }>MASSA-CARRARA</option>
											<option value="MT" { if $provincia == "MT" } selected = "selected"{ /if }>MATERA</option>
											<option value="ME" { if $provincia == "ME" } selected = "selected"{ /if }>MESSINA</option>
											<option value="MI" { if $provincia == "MI" } selected = "selected"{ /if }>MILANO</option>
											<option value="MO" { if $provincia == "MO" } selected = "selected"{ /if }>MODENA</option>
											<option value="NA" { if $provincia == "NA" } selected = "selected"{ /if }>NAPOLI</option>
											<option value="NO" { if $provincia == "NO" } selected = "selected"{ /if }>NOVARA</option>
											<option value="NU" { if $provincia == "NU" } selected = "selected"{ /if }>NUORO</option>
											<option value="OR" { if $provincia == "OR" } selected = "selected"{ /if }>ORISTANO</option>
											<option value="PD" { if $provincia == "PD" } selected = "selected"{ /if }>PADOVA</option>
											<option value="PA" { if $provincia == "PA" } selected = "selected"{ /if }>PALERMO</option>
											<option value="PR" { if $provincia == "PR" } selected = "selected"{ /if }>PARMA</option>
											<option value="PV" { if $provincia == "PV" } selected = "selected"{ /if }>PAVIA</option>
											<option value="PG" { if $provincia == "PG" } selected = "selected"{ /if }>PERUGIA</option>
											<option value="PU" { if $provincia == "PU" } selected = "selected"{ /if }>PESARO E URBINO</option>
											<option value="PE" { if $provincia == "PE" } selected = "selected"{ /if }>PESCARA</option>
											<option value="PC" { if $provincia == "PC" } selected = "selected"{ /if }>PIACENZA</option>
											<option value="PI" { if $provincia == "PI" } selected = "selected"{ /if }>PISA</option>
											<option value="PT" { if $provincia == "PT" } selected = "selected"{ /if }>PISTOIA</option>
											<option value="PN" { if $provincia == "PN" } selected = "selected"{ /if }>PORDENONE</option>
											<option value="PZ" { if $provincia == "PZ" } selected = "selected"{ /if }>POTENZA</option>
											<option value="PO" { if $provincia == "PO" } selected = "selected"{ /if }>PRATO</option>
											<option value="RG" { if $provincia == "RG" } selected = "selected"{ /if }>RAGUSA</option>
											<option value="RA" { if $provincia == "RA" } selected = "selected"{ /if }>RAVENNA</option>
											<option value="RC" { if $provincia == "RC" } selected = "selected"{ /if }>REGGIO DI CALABRIA</option>
											<option value="RE" { if $provincia == "RE" } selected = "selected"{ /if }>REGGIO NELL'EMILIA</option>
											<option value="RI" { if $provincia == "RI" } selected = "selected"{ /if }>RIETI</option>
											<option value="RN" { if $provincia == "RN" } selected = "selected"{ /if }>RIMINI</option>
											<option value="RM" { if $provincia == "RM" } selected = "selected"{ /if }>ROMA</option>
											<option value="RO" { if $provincia == "RO" } selected = "selected"{ /if }>ROVIGO</option>
											<option value="SA" { if $provincia == "SA" } selected = "selected"{ /if }>SALERNO</option>
											<option value="SS" { if $provincia == "SS" } selected = "selected"{ /if }>SASSARI</option>
											<option value="SV" { if $provincia == "SV" } selected = "selected"{ /if }>SAVONA</option>
											<option value="SI" { if $provincia == "SI" } selected = "selected"{ /if }>SIENA</option>
											<option value="SR" { if $provincia == "SR" } selected = "selected"{ /if }>SIRACUSA</option>
											<option value="SO" { if $provincia == "SO" } selected = "selected"{ /if }>SONDRIO</option>
											<option value="TA" { if $provincia == "TA" } selected = "selected"{ /if }>TARANTO</option>
											<option value="TE" { if $provincia == "TE" } selected = "selected"{ /if }>TERAMO</option>
											<option value="TR" { if $provincia == "TR" } selected = "selected"{ /if }>TERNI</option>
											<option value="TO" { if $provincia == "TO" } selected = "selected"{ /if }>TORINO</option>
											<option value="TP" { if $provincia == "TP" } selected = "selected"{ /if }>TRAPANI</option>
											<option value="TN" { if $provincia == "TN" } selected = "selected"{ /if }>TRENTO</option>
											<option value="TV" { if $provincia == "TV" } selected = "selected"{ /if }>TREVISO</option>
											<option value="TS" { if $provincia == "TS" } selected = "selected"{ /if }>TRIESTE</option>
											<option value="UD" { if $provincia == "UD" } selected = "selected"{ /if }>UDINE</option>
											<option value="VA" { if $provincia == "VA" } selected = "selected"{ /if }>VARESE</option>
											<option value="VE" { if $provincia == "VE" } selected = "selected"{ /if }>VENEZIA</option>
											<option value="VB" { if $provincia == "VB" } selected = "selected"{ /if }>VERBANO-CUSIO-OSSOLA</option>
											<option value="VC" { if $provincia == "VC" } selected = "selected"{ /if }>VERCELLI</option>
											<option value="VR" { if $provincia == "VR" } selected = "selected"{ /if }>VERONA</option>
											<option value="VV" { if $provincia == "VV" } selected = "selected"{ /if }>VIBO VALENTIA</option>
											<option value="VI" { if $provincia == "VI" } selected = "selected"{ /if }>VICENZA</option>
											<option value="VT" { if $provincia == "VT" } selected = "selected"{ /if }>VITERBO</option>
									</select></td>
	</tr>
	<tr>
		<td>CAP</td>
		<td style="text-align : right"><input type="text" name="cap" value="{$cap}" size="5" maxlength="5" /></td>
	</tr>
	{ if ! $read_only }
	<tr>
		<td>&nbsp;</td>
		<td style="text-align : right"><input type="submit" value="Invia" size="5" { if $modifica_utente } onclick="return conferma();" { /if } /></td>
	</tr>
	{ /if }
	</table>
	<input type="hidden" name="step" value="2" />
</form>