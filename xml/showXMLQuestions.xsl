<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" encoding="UTF-8"/>
<xsl:template match="/">
<html>
<head><title>Questions</title>
</head>
<body>
<table width="100%" border="1">
  <THEAD>
           <TR>
                <TH><B>Author</B></TH>
				<TH><B>Question</B></TH>
				<TH><B>Right answer</B></TH>
                <TH><B>Wrong answers</B></TH>
				<TH><B>Subject</B></TH>
          </TR>
   </THEAD> 
  <TBODY>
             <xsl:for-each select="assessmentItems/assessmentItem">
             <TR> 
                  <TD><xsl:value-of select="@author" /></TD>   
                  <TD><xsl:value-of select="itemBody" /></TD>  
				  <TD><xsl:value-of select="correctResponse/value" /></TD>
				  <TD><xsl:for-each select="incorrectResponses/value"><xsl:value-of select="text()" /><br/></xsl:for-each></TD>
				  <TD><xsl:value-of select="@subject" /></TD>
            </TR>
            </xsl:for-each>
  </TBODY>
</table>
</body>
</html>
</xsl:template>
</xsl:stylesheet>