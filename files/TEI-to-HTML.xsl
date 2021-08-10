<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"  xmlns:tei="http://www.tei-c.org/ns/1.0">
<xsl:output method="html" version="4.0"
    encoding="UTF-8" indent="no"/>

    <xsl:template match="/">
      <html>
        <body>
          <div class="kommentaarit">
            <xsl:apply-templates select="//tei:div[@type='kommentaarit']" />
          </div>
          <div class="loitsu">
            <xsl:apply-templates select="//tei:div[@type='teksti']" />
          </div>
          <div class="tiedot">
            <xsl:apply-templates select="//tei:div[@type='tiedot']" />
          </div>
          <div class="tiedot_b">
            <xsl:apply-templates select="//tei:div[@type='tiedot_b']" />
          </div>
          <div class="tiedot_c">
            <xsl:apply-templates select="//tei:div[@type='tiedot_c']" />
          </div>
          <div class="tiedot_d">
            <xsl:apply-templates select="//tei:div[@type='tiedot_d']" />
          </div>
          <div class="nykytulkinta">
            <xsl:apply-templates select="//tei:div[@type='nykytulkinta']" />
          </div>
        </body>
      </html>
    </xsl:template>

    <xsl:template match="//tei:lg">
      <p><xsl:apply-templates/></p>
    </xsl:template>

    <xsl:template match="//tei:l">
      <span class="line"><xsl:apply-templates/></span><br />
    </xsl:template>

    <xsl:template match="tei:p">
      <p><xsl:apply-templates/></p>
    </xsl:template>

    <xsl:template match="tei:pb">
      <p class="pb"><xsl:value-of select="current()/@n" /></p>
    </xsl:template>

    <xsl:template match="tei:note[@type = 'tuomioc']">
      <p class="tuomioc"><xsl:apply-templates /></p>
    </xsl:template>

    <xsl:template match="tei:add">
      <span class="sup" title="lisäys"><xsl:apply-templates/></span>  
    </xsl:template>

    <xsl:template match="tei:hi[@rend = 'underline']">
      <span class="underline" title="alleviivaus"><xsl:apply-templates/></span>
    </xsl:template>

    <xsl:template match="tei:hi[@rend = 'italics']">
      <span style="font-style:italic;"><xsl:apply-templates /></span>
    </xsl:template>

    <xsl:template match="tei:hi[@rend = 'superscript']">
      <span class="superscript" title="yläindeksi"><xsl:apply-templates /></span>
    </xsl:template>

    <xsl:template match="tei:hi[@rend = 'red']">
      <span class="red"><xsl:apply-templates /></span>
    </xsl:template>

    <xsl:template match="tei:lb">
      <xsl:text disable-output-escaping="yes">&lt;br&gt;</xsl:text>
    </xsl:template>

    <xsl:template match="tei:ref[@type = 'link']">
      <xsl:variable name="url"><xsl:value-of select="current()/@target" /></xsl:variable>
      <a class="link" href="{$url}" target="_blank" title="linkki"><xsl:apply-templates /></a>
    </xsl:template>

    <xsl:template match="tei:ref[@type = 'spell_link']">
      <xsl:variable name="url"><xsl:value-of select="current()/@target" /></xsl:variable>
      <xsl:variable name="url2"><xsl:value-of select="current()/@n" /></xsl:variable>
      <a class="link" href="{$url}" target="_blank" title="{$url2}"><xsl:apply-templates /></a>
    </xsl:template>

    <xsl:template match="tei:ref[@type = 'more']">
      <a class="more"><xsl:apply-templates /></a>
    </xsl:template>

    <xsl:template match="//tei:emph">
      <span class="bolded"><xsl:apply-templates/></span>
    </xsl:template>

    <xsl:template match="tei:del">
      <span class="del" title="poisto"><xsl:apply-templates/></span>
    </xsl:template>

    <xsl:template match="tei:unclear">
      <span class="unclear" title="epäselvä kohta"><xsl:apply-templates/></span>
    </xsl:template>

    <xsl:template match="tei:app">
      <a class="tooltip2" href="#"><xsl:value-of select="current()/tei:lem" /></a>
      <span><xsl:value-of select="current()/tei:rdg" /></span>
    </xsl:template>

    <xsl:template match="tei:table">
      <table>
        <xsl:apply-templates/>
      </table>
    </xsl:template>

    <xsl:template match="tei:table/tei:row">
      <tr>
        <xsl:apply-templates/>
      </tr>
    </xsl:template>

    <xsl:template match="tei:table/tei:row/tei:cell">
      <td>
        <xsl:apply-templates/>
      </td>
    </xsl:template>

    <xsl:template match="tei:gap">
      <span style="background-color:grey;color:grey;"><xsl:text>gap</xsl:text></span>
    </xsl:template>

    <xsl:template match="tei:div[@type = 'kommentaarit']/tei:note">
      <p name="{current()/@n}"><xsl:apply-templates /></p>
    </xsl:template>

    <xsl:template match="tei:label[@type = 'commentary']">
      <a class="tooltip3" name="{current()/@n}"><xsl:value-of select="current()"/></a>
    </xsl:template>

    <xsl:template match="tei:label[@type = 'comment']" >
      <a class="tooltip1"><xsl:value-of select="node()"/></a>
      <span><xsl:apply-templates select="//tei:note[@n=current()/@n]" /></span>
    </xsl:template>

    <xsl:template match="tei:choice">
      <a class="tooltip2" href="#"><xsl:apply-templates select="current()/tei:abbr" />
      <span><xsl:apply-templates select="current()/tei:expan" /></span>
      </a>
    </xsl:template>


  </xsl:stylesheet>
