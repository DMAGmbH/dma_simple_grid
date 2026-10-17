# DMA SimpleGrid
Contao Erweiterung, die einfache Strukturen für Grid-Systeme bietet:
- Verschachtelte Row- und Column-Inhaltselemente
- Bisherige Row-/Column-Start-/Stop-Elemente für Inhalte und Formulare
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

In der Grid-Kategorie stehen die Inhaltselemente **Row** und **Column** zur Verfügung. Über „Kind-Elemente bearbeiten“ lassen sich darin weitere Inhaltselemente anlegen.

Eine Row kann Inhalte direkt aufnehmen. Deren Breiten und Verschiebungen werden wie bisher am jeweiligen Inhaltselement eingestellt. Eine zusätzliche Column ist optional und fasst mehrere Inhalte in einer gemeinsamen Grid-Spalte zusammen. Auch innerhalb einer Column können weitere Rows angelegt werden.

Rows verwenden die Row- und gegebenenfalls Block-Grid-Klassen des aktiven Profils. Columns verwenden dessen Spalten-, Offset-, Push-/Pull- und zusätzliche Spaltenklassen. Die verfügbaren Einstellungen richten sich nach den SimpleGrid-Einstellungen; Profile ohne Rows bieten das Row-Element nicht an. Ein Titel dient der Orientierung im Backend; CSS-ID, eigene Klassen, Zugriffsschutz und Veröffentlichungszeitraum verwenden die normalen Contao-Felder.

Die Twig-Templates heißen `content_element/simple_grid/row.html.twig` und `content_element/simple_grid/column.html.twig`. Sie erweitern die Core-Elementgruppe und können über eigene Twig-Varianten angepasst werden. Die Grid-Klassen stehen als `grid_classes` zur Verfügung und werden über den Attributhelfer am Container ausgegeben.

Die bisherigen Row-/Column-Start-/Stop-Inhaltselemente bleiben mit dem Suffix „ – legacy“ in derselben Grid-Kategorie verfügbar. Bestehende Inhalte werden nicht migriert. Wrapper-Start/-Stop und die Formularfelder bleiben unverändert.

### Update von älteren Versionen

Bestehende Grid-Einstellungen können ohne Datenmigration weiterverwendet werden. Die Bearbeitung erfolgt jetzt über den Row-Wizard des Contao-Cores. Die bisherige Abhängigkeit vom MultiColumnWizard entfällt; andere Erweiterungen können ihn weiterhin benötigen.

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
