
plugin.tx_carrental_information {
    view {
        templateRootPaths.0 = EXT:car_rental/Resources/Private/Templates/
        templateRootPaths.1 = {$plugin.tx_carrental_information.view.templateRootPath}
        partialRootPaths.0 = EXT:car_rental/Resources/Private/Partials/
        partialRootPaths.1 = {$plugin.tx_carrental_information.view.partialRootPath}
        layoutRootPaths.0 = EXT:car_rental/Resources/Private/Layouts/
        layoutRootPaths.1 = {$plugin.tx_carrental_information.view.layoutRootPath}
    }
    persistence {
        storagePid = {$plugin.tx_carrental.persistence.storagePid}
        #recursive = 1
    }
    features {
        #skipDefaultArguments = 1
        # if set to 1, the enable fields are ignored in BE context
        ignoreAllEnableFieldsInBe = 0
        # Should be on by default, but can be disabled if all action in the plugin are uncached
        requireCHashArgumentForActionArguments = 1
    }
    mvc {
        #callDefaultActionIfActionCantBeResolved = 1
    }
    settings {
        pages {
            rent = {$plugin.tx_carrental.settings.pages.rent}
        }
    }
}

plugin.tx_carrental_rental {
    view {
        templateRootPaths.0 = EXT:car_rental/Resources/Private/Templates/
        partialRootPaths.0 = EXT:car_rental/Resources/Private/Partials/
        layoutRootPaths.0 = EXT:car_rental/Resources/Private/Layouts/
    }
    persistence {
        storagePid = {$plugin.tx_carrental.persistence.storagePid}
        #recursive = 1
    }
    features {
        #skipDefaultArguments = 1
        # if set to 1, the enable fields are ignored in BE context
        ignoreAllEnableFieldsInBe = 0
        # Should be on by default, but can be disabled if all action in the plugin are uncached
        requireCHashArgumentForActionArguments = 1
    }
    mvc {
        #callDefaultActionIfActionCantBeResolved = 1
    }
}

plugin.tx_carrental_management {
    view {
        templateRootPaths.0 = EXT:car_rental/Resources/Private/Templates/
        partialRootPaths.0 = EXT:car_rental/Resources/Private/Partials/
        layoutRootPaths.0 = EXT:car_rental/Resources/Private/Layouts/
    }
    persistence {
        storagePid = {$plugin.tx_carrental.persistence.storagePid}
        #recursive = 1
    }
    features {
        #skipDefaultArguments = 1
        # if set to 1, the enable fields are ignored in BE context
        ignoreAllEnableFieldsInBe = 0
        # Should be on by default, but can be disabled if all action in the plugin are uncached
        requireCHashArgumentForActionArguments = 1
    }
    mvc {
        #callDefaultActionIfActionCantBeResolved = 1
    }
}
