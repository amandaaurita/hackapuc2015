//
//  BetViewController.swift
//  
//
//

import UIKit

class BetViewController: UIViewController, UITableViewDelegate, UITableViewDataSource {
    
    
    //-----Table View------
    var tableView: UITableView!
    
    //-----Células---------
    var betCell : BetSmallCell!

       
    override func viewDidLoad()
    {
        super.viewDidLoad()
        
        //--------View
        self.view.backgroundColor = UIColor.whiteColor()
        let bounds = UIScreen.mainScreen().bounds
        let width = bounds.size.width
        let height = bounds.size.height
        self.tabBarController?.tabBar.tintColor = UIColor.azulBebe()
        
        //--------Table View
        self.tableView = UITableView(frame: CGRectMake(0, height/5, self.view.frame.width, self.view.frame.height/1.785))
        self.tableView.backgroundColor = UIColor.azulBebe()
        self.tableView.center.x = self.view.center.x
        self.tableView.delegate = self
        self.tableView.dataSource = self
        self.tableView.registerClass(BetSmallCell.self, forCellReuseIdentifier: "BetSmallCell")
        self.tableView.separatorStyle = .None
        self.view.addSubview(self.tableView)
        
        
    }
    
    //MARK: Funções do delegate e datasource da TableView
    func numberOfSectionsInTableView(tableView: UITableView) -> Int
    {
        return 1
    }
    
    func tableView(tableView: UITableView, numberOfRowsInSection section: Int) -> Int
    {
//                if let selectedCellIndexPath = selectedCellIndexPath {
//                    if selectedCellIndexPath == indexPath {
//                        return SelectedCellHeight
//                    }
//                }
//                return UnselectedCellHeight
        
        
        return SystemStatus.sharedInstance.user.bets.count
    }
    
    func tableView(tableView: UITableView, heightForRowAtIndexPath indexPath: NSIndexPath) -> CGFloat {

        return 100
    }
    
    func tableView(tableView: UITableView, cellForRowAtIndexPath indexPath: NSIndexPath) -> UITableViewCell
    {
        betCell = tableView.dequeueReusableCellWithIdentifier("BetSmallCell", forIndexPath: indexPath) as! BetSmallCell
        betCell.selectionStyle = .None
        print(SystemStatus.sharedInstance.user.email)
        print(SystemStatus.sharedInstance.user)
        betCell.sportLbl.text = (SystemStatus.sharedInstance.user.bets[indexPath.row].game.modality)! as String
        betCell.time.text = SystemStatus.sharedInstance.nsdate2string((SystemStatus.sharedInstance.user.bets[indexPath.row].game.time!))
        
        
//        print(SystemStatus.sharedInstance.games[0].participant[0].country_code)
        
        betCell.team1.image = UIImage(named: "48_\(SystemStatus.sharedInstance.user.bets[indexPath.row].game.participant[0].country_code)")
        betCell.team2.image = UIImage(named: "48_\(SystemStatus.sharedInstance.user.bets[indexPath.row].game.participant[1].country_code)")
        betCell.result.text = "Your bet: \(SystemStatus.sharedInstance.user.bets[indexPath.row].chosenResult! as String)"

        
   
        
        return betCell
    }
    
    //    func tableView(tableView: UITableView, willDisplayCell cell: UITableViewCell, forRowAtIndexPath indexPath: NSIndexPath)
    //    {
    //        if cell.respondsToSelector("setSeparatorInset:")
    //        {
    //            cell.separatorInset = UIEdgeInsetsZero
    //        }
    //        if cell.respondsToSelector("setLayoutMargins:")
    //        {
    //            cell.layoutMargins = UIEdgeInsetsZero
    //        }
    //        if cell.respondsToSelector("setPreservesSuperviewLayoutMargins:")
    //        {
    //            cell.preservesSuperviewLayoutMargins = false
    //        }
    //    }
    //
    func tableView(tableView: UITableView, didSelectRowAtIndexPath indexPath: NSIndexPath) {
//        
//        if let selectedCellIndexPath = selectedCellIndexPath {
//            if selectedCellIndexPath == indexPath {
//                self.selectedCellIndexPath = nil
//            } else {
//                self.selectedCellIndexPath = indexPath
//            }
//        } else {
//            selectedCellIndexPath = indexPath
//        }
//        tableView.beginUpdates()
//        tableView.endUpdates()
    }
    
    func action(){
        print("rolou o tap")
    }
    //
    //    func bairroTouched(bairro: UITableViewCell)
    //    {
    //        (self.flowerPageViewController?.viewControllers?.last as! FlowerContent).priceLabel.text = ""
    //        (self.flowerPageViewController?.viewControllers?.last as! FlowerContent).flowerLabel.text = ""
    //        (self.flowerPageViewController?.viewControllers?.last as! FlowerContent).flowerImage.image = nil
    //
    //        print(bairro.textLabel?.text)
    //
    //        /* TODO: ???? */
    //        for view in self.view.subviews
    //        {
    //            view.removeFromSuperview()
    //        }
    //
    //        SystemStatus.sharedInstance.deliveryDistrict = bairro.textLabel?.text
    //        daoB.getFloresWithBairro(SystemStatus.sharedInstance.deliveryDistrict)
    //        toggleDistrictPicker()
    //        self.viewDidLoad()
    //    }
    
}
