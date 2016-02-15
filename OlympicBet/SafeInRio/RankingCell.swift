//
//  RankingCell.swift
//  SafeInRio
//
//  Created by Amanda Aurita Araujo Fernandes on 12/12/15.
//  Copyright © 2015 Amanda Aurita Araujo Fernandes. All rights reserved.
//

import UIKit

class RankingCell: UITableViewCell {
    
    var userLbl = UILabel()
    let margem:CGFloat = 10.0

    override func awakeFromNib() {
        super.awakeFromNib()
       // super.init(frame: frame)
        self.backgroundColor = UIColor.verdeClaro()
        
        let content = UIView(frame: CGRectMake(margem, margem, self.frame.width - 2 * margem, self.frame.height - 2 * margem))
        content.backgroundColor = UIColor.azulEscuro()
        content.layer.cornerRadius = 10
        self.addSubview(content)
        
        self.userLbl.frame = CGRectMake(0, 0, frame.width, frame.height)
        self.userLbl.text = "Fulano"
        content.addSubview(userLbl)
    }

    override func setSelected(selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)

        // Configure the view for the selected state
    }

}
