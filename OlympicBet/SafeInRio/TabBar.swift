//
//  TabBar.swift
//  SafeInRio
//
//  Created by Amanda Aurita Araujo Fernandes on 12/12/15.
//  Copyright © 2015 Amanda Aurita Araujo Fernandes. All rights reserved.
//

import UIKit

class TabBar: UITabBarController, UITabBarControllerDelegate  {
    
    private var gvc = BetViewController()
    private var bvc = GameViewController()
    
    override func viewDidLoad() {
        super.viewDidLoad()
        delegate = self
    }
    
    override func viewWillAppear(animated: Bool) {


    }
    
    //Delegate methods
    func tabBarController(tabBarController: UITabBarController, shouldSelectViewController viewController: UIViewController) -> Bool {
        print("Should select viewController: \(viewController.title) ?")
        return true;
    }
}



/*
// Only override drawRect: if you perform custom drawing.
// An empty implementation adversely affects performance during animation.
override func drawRect(rect: CGRect) {
// Drawing code
}
*/


