# DMA SimpleGrid
Contao Erweiterung, die einfache Strukturen für Grid-Systeme bietet:
- Verschachtelte Wrapper-, Row- und Column-Inhaltselemente
- Legacy-Start-/Stop-Inhaltselemente und Row-/Column-Formularfelder
- Selektoren für Spalten-Breiten sowie Offset-, Pull- und Push-Werte
- Konfigurationsarray für Bootstrap und Foundation

## Abhängigkeiten

- PHP `^8.3`
- Contao `^5.7`

## Installation
- Die Erweiterung *DMA SimpleGrid* über Composer installieren.
- Im Contao-Backend befinden sich im Bereich *Einstellungen* nun neue Einstellungsmöglichkeiten für die Simple Grid-Erweiterung
	- Auswahl des zu verwendenden Frameworks oder Grid-System (CSS- und weitere Dateien werden nicht installiert, da hier jeder seine eigenen Ansprüche hat)
	- Auswahl der zu verwendenden Selektoren
- Anschließend sollten bei den einzelnen Inhaltselementen Select-Felder zur jeweiligen Auswahl der Grid-Einstellungen zur Verfügung stehen.

## Weitere Hinweise

### Verschachtelte Grid-Inhaltselemente

In der Grid-Kategorie stehen die Inhaltselemente **Wrapper**, **Row** und **Column** zur Verfügung. Über „Kind-Elemente bearbeiten“ lassen sich darin weitere Inhaltselemente anlegen.

Ein Wrapper fasst beliebige Inhalte, Rows und Columns in einem gemeinsamen Grid-Container zusammen. Er verwendet die Wrapper-Klasse und die aktivierten zusätzlichen Wrapper-Klassen des gewählten Profils.

Eine Row kann Inhalte direkt aufnehmen. Deren Breiten und Verschiebungen werden wie bisher am jeweiligen Inhaltselement eingestellt. Eine zusätzliche Column ist optional und fasst mehrere Inhalte in einer gemeinsamen Grid-Spalte zusammen. Auch innerhalb einer Column können weitere Rows angelegt werden.

Bei direkten Kindern einer Column werden Breite, Offset, Push/Pull und zusätzliche Spaltenklassen im Backend ausgeblendet; diese Einstellungen gehören an den Column-Container. Eine darin verschachtelte Row behält ihre Row-Einstellungen, und deren direkte Kinder erhalten wieder Spalteneinstellungen. Vorhandene Werte werden durch das Ausblenden nicht gelöscht; ihre bisherige Ausgabe bleibt erhalten.

Rows verwenden die Row- und gegebenenfalls Block-Grid-Klassen des aktiven Profils. Columns verwenden dessen Spalten-, Offset-, Push-/Pull- und zusätzliche Spaltenklassen. Die verfügbaren Einstellungen richten sich nach den SimpleGrid-Einstellungen; Profile ohne Rows bieten das Row-Element nicht an; Profile ohne Wrapper bieten das Wrapper-Element nicht an. Ein Titel dient der Orientierung im Backend; CSS-ID, eigene Klassen, Zugriffsschutz und Veröffentlichungszeitraum verwenden die normalen Contao-Felder.

Die Twig-Templates liegen unter `content_element/simple_grid/` und heißen `wrapper.html.twig`, `row.html.twig` und `column.html.twig`. Sie erweitern die Core-Elementgruppe und können über eigene Twig-Varianten angepasst werden. Die Grid-Klassen stehen als `grid_classes` zur Verfügung und werden über den Attributhelfer am Container ausgegeben.

Die bisherigen Wrapper-/Row-/Column-Start-/Stop-Inhaltselemente bleiben mit dem Suffix „ – legacy“ in derselben Grid-Kategorie verfügbar. Bestehende Inhalte werden nicht migriert. Die Formularfeldtypen bleiben erhalten; ihre Templates sind ebenfalls auf Twig umgestellt.

Unter **Einstellungen → DMA SimpleGrid Einstellungen** können diese sechs alten Inhaltselementtypen mit **„Legacy-Elemente ausblenden“** aus der Typauswahl ausgeblendet werden. Die Option ist standardmäßig deaktiviert. Bestehende Legacy-Inhalte bleiben nutzbar; beim Bearbeiten bleibt ihr aktueller Typ in der Auswahl erhalten. Formularfelder und die Legacy-Elemente des Contao-Cores sind von dieser Option ausgenommen.

### Update von älteren Versionen

Bestehende Grid-Einstellungen können ohne Datenmigration weiterverwendet werden. Die Bearbeitung erfolgt jetzt über den Row-Wizard des Contao-Cores. Die bisherige Abhängigkeit vom MultiColumnWizard entfällt; andere Erweiterungen können ihn weiterhin benötigen.

### Neue Major-Version: Umstellung auf Twig

Alle mitgelieferten Grid-Templates verwenden jetzt Twig, auch unter Contao 5.7. Die bisherigen Inhaltstypen, Start-/Stop-Paare, IDs und Grid-Klassen bleiben erhalten. Eigene PHP-Template-Anpassungen müssen vor dem Update auf Twig portiert werden. Es gibt keinen PHP-Fallback für die mitgelieferten Templates und keine automatische Konvertierung eigener Templates.

| Bisheriges PHP-Template | Neues Twig-Template |
| --- | --- |
| `ce_dma_simplegrid_wrapperstart.html5` | `content_element/simple_grid/legacy/wrapper_start.html.twig` |
| `ce_dma_simplegrid_wrapperstop.html5` | `content_element/simple_grid/legacy/wrapper_stop.html.twig` |
| `ce_dma_simplegrid_rowstart.html5` | `content_element/simple_grid/legacy/row_start.html.twig` |
| `ce_dma_simplegrid_rowstop.html5` | `content_element/simple_grid/legacy/row_stop.html.twig` |
| `ce_dma_simplegrid_columnstart.html5` | `content_element/simple_grid/legacy/column_start.html.twig` |
| `ce_dma_simplegrid_columnstop.html5` | `content_element/simple_grid/legacy/column_stop.html.twig` |
| `form_dma_simplegrid_rowstart.html5` | `form_dma_simplegrid_row_start.html.twig` |
| `form_dma_simplegrid_rowstop.html5` | `form_dma_simplegrid_row_stop.html.twig` |
| `form_dma_simplegrid_columnstart.html5` | `form_dma_simplegrid_column_start.html.twig` |
| `form_dma_simplegrid_columnstop.html5` | `form_dma_simplegrid_column_stop.html.twig` |

Eigene Overrides liegen unterhalb des Projektverzeichnisses `templates/` mit dem jeweiligen neuen Pfad. Beispielsweise wird ein Row-Start-Override unter `templates/content_element/simple_grid/legacy/row_start.html.twig` abgelegt. Eine zusätzliche Klasse kann dort so ergänzt werden:

```twig
{% extends '@Contao/content_element/simple_grid/legacy/row_start.html.twig' %}

{% set attributes = attrs(attributes|default).addClass('my-row') %}
```

Die Start-Templates bieten den Block `wrapper_start`, die Stop-Templates `wrapper_stop`. Ein Start-Template öffnet weiterhin nur den Container, das zugehörige Stop-Template schließt ihn. Die neuen Nested-Templates erzeugen dagegen vollständige Container und sind kein Ersatz für diese Start-/Stop-Templates.

Inhalts-Template-Varianten können z. B. unter `content_element/simple_grid/legacy/row_start/custom.html.twig` angelegt werden. Formularvarianten folgen dem Core-Präfix, z. B. `form_dma_simplegrid_row_start_custom.html.twig`. Sie erweitern das jeweilige Standardtemplate und lassen sich im Feld „Individuelles Template“ auswählen. Bei bisher ausgewählten eigenen PHP-Varianten muss die entsprechende Twig-Variante nach der Portierung neu ausgewählt werden. Die Formular-Templates verwenden `this.prefix` und `this.class`; die Inhalts-Templates erhalten `legacy_css_classes`, `element_html_id`, `element_css_classes` und `data` vom Fragment-Controller.

Die bisherigen PHP-Klassennamen `DMA\ContentSimpleGrid…` bleiben als Proxies für die Fragment-Controller vorhanden. Eigene Unterklassen, die ihre Ausgabe über `compile()` verändert haben, müssen auf Twig-Overrides bzw. angepasste Fragment-Controller umgestellt werden. Der `parseTemplate`-Hook bleibt ausschließlich als Kompatibilitätsanschluss für fremde PHP-Inhaltselemente unter Contao 5.7 erhalten; die eigenen Grid-Inhaltselemente verwenden Fragment-Controller und Twig.

Nach dem Update den Contao-Cache erneuern. Die Contao-6-Freigabe ist noch ausstehend; die Composer-Anforderung bleibt vorerst bei `^5.7`.

### Wechsel des Grid-Profils

Beim Speichern eines Grid-Einstellungsfeldes werden nur die Breakpoints des aktiven Grid-Profils übernommen. Werte für dort nicht mehr vorhandene Breakpoints werden entfernt und stehen bei einem späteren Wechsel zurück nicht mehr zur Verfügung. Der Profilwechsel allein verändert keine gespeicherten Elementdaten.

### Was diese Erweiterung nicht kann
- CSS etc. werden durch diese Erweiterung nicht mitgebracht. Jeder kann es auf seine eigene Art und Weise in Contao integrieren
- Kombinierte Grid-Einstellungen werden nicht auf vollständige Zeilen etc. validiert
- Nicht alle Grid-Systeme lassen sich allein durch das vorhandene Profilmodell vollständig abbilden. Eigene Klassen und Twig-Varianten können zusätzliche Anpassungen erfordern.

### Erweiterung der Grid-Einstellungen
Standardmäßig wird diese Erweiterung mit dem Support für das Contao Grid, das Grid von Bootstrap 3, Bootstrap 4, Foundation 6 und unsemantic sowie dem GoldenRatio Grid von uns ausgeliefert. Über eigene `config.php`-Dateien können weitere Grid-Systeme unterstützt werden (hier als Beispiel die Konfiguration für das Foundation-Grid):
```
$GLOBALS['DMA_SIMPLEGRID_CONFIG']['foundation'] = array
(
    'name' => 'Foundation',
    'config' => array
    (
        'hasRows' => true,
        'hasColumns' => true,
        'hasColumnOffset' => true,
        'hasColumnOffsetRight' => false,
        'hasColumnPush' => true,
        'hasColumnPull' => true,
        'hasRowClasses' => true,
        'hasColumnClasses' => true,
        'row-class' => 'row',
        'column-class' => 'columns',
        'columns-sizes' => array('1','2','3','4','5','6','7','8','9','10','11','12'),
        'columns-config' => array
        (
            'small' => array
            (
                'name' => 'small',
                'column-class' => 'small-%d',
                'offset-class' => 'small-offset-%d',
                'push-class' => 'small-push-%d',
                'pull-class' => 'small-pull-%d'
            ),
            'medium' => array
            (
                'name' => 'medium',
                'column-class' => 'medium-%d',
                'offset-class' => 'medium-offset-%d',
                'push-class' => 'medium-push-%d',
                'pull-class' => 'medium-pull-%d'
            ),
            'large' => array
            (
                'name' => 'large',
                'column-class' => 'large-%d',
                'offset-class' => 'large-offset-%d',
                'push-class' => 'large-push-%d',
                'pull-class' => 'large-pull-%d'
            )
        ),
        'additional-classes' => array
        (
            'row' => array('expanded'),
            'columns' => array
            (
                'end' => 'end',
                'small-centered' => 'small-centered',
                'medium-centered' => 'medium-centered',
                'large-centered' => 'large-centered'
            )
        )
    )
);
```
