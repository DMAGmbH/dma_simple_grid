# DMA SimpleGrid
Contao Erweiterung, die einfache Strukturen für Grid-Systeme bietet:
- Row-Elemente (für Inhalts-Elemente und Formulare)
- Spalten-Elemente (für Inhalts-Elemente und Formulare)
- Selektoren für Spalten-Breiten sowie Offset-, Pull- und Push-Werte
- Konfigurationsarray für Bootstrap und Foundation

## Abhängigkeiten
https://github.com/menatwork/MultiColumnWizard

## Installation
- zunächst muss die Erweiterung *MultiColumnWizard* installiert werden.
- anschließend kann die Erweitunerung *DMA SimpleGrid* installiert werden.
- Im Contao-Backend befinden sich im Bereich *Einstellungen* nun neue Einstellungsmöglichkeiten für die Simple Grid-Erweiterung
	- Auswahl des zu verwendenden Frameworks oder Grid-System (CSS- und weitere Dateien werden nicht installiert, da hier jeder seine eigenen Ansprüche hat)
	- Auswahl der zu verwendenden Selektoren
- Anschließend sollten bei den einzelnen Inhaltselementen Select-Felder zur jeweiligen Auswahl der Grid-Einstellungen zur Verfügung stehen.

## Weitere Hinweise
### Was diese Erweiterung nicht kann
- CSS etc. werden durch diese Erweiterung nicht mitgebracht. Jeder kann es auf seine eigene Art und Weise in Contao integrieren
- Kombinierte Grid-Einstellungen werden nicht auf vollständige Zeilen etc. validiert
- Alle Grids können aufgrund ihrer Struktur nicht abgebildet werden. Insbesondere verschachtelte Div-Strukturen (wie sie beispielsweise bei YAML verwendet werden) lassen sich nicht realisieren.

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

