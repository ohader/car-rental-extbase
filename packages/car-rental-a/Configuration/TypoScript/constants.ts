plugin.tx_carrental {
    persistence {
        # cat=plugin.tx_carrental_information//a; type=string; label=Default storage PID
        storagePid =
    }
    settings {
        pages {
            # cat=car_rental; type=int+; label=Rent Page Id
            rent =
        }
    }
}

plugin.tx_carrental_information {
    view {
        # cat=plugin.tx_carrental_information/file; type=string; label=Path to template root (FE)
        templateRootPath = EXT:car_rental/Resources/Private/Templates/
        # cat=plugin.tx_carrental_information/file; type=string; label=Path to template partials (FE)
        partialRootPath = EXT:car_rental/Resources/Private/Partials/
        # cat=plugin.tx_carrental_information/file; type=string; label=Path to template layouts (FE)
        layoutRootPath = EXT:car_rental/Resources/Private/Layouts/
    }
}
